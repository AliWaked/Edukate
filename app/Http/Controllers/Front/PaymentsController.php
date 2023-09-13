<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PSpell\Config;

class PaymentsController extends Controller
{
    public function create(Course $course)
    {
        // dd($course);
        return view('front.payment', [
            'course' => $course,
        ]);
    }
    public function createStripePaymentIntent(Course $course)
    {
        $price = $course->price;
        if (!(Auth::guard('web')->user()->courses->first->id)) {
            $price -= $price * (30 / 100);
        }
        $price = (int) $price;
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $price,
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }
    public function confirm(Request $request, Course $course)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        if ($paymentIntent->status = 'succeeded') {
            $payment = new Payment;
            $payment->forceFill([
                'course_id' => $course->id,
                'price' => $paymentIntent->amount,
                'status' => 'complete',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
            ])->save();
            // event()
            Rating::create([
                'user_id' => Auth::guard('web')->user()->id,
                'course_id' => $course->id,
                'status' => 'paid'
            ]);
            return redirect()->route('home');
        }
    }
}
