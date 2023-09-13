<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CoursesControllr;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InformationsController;
use App\Http\Controllers\Dashboard\InstrctorController;
use App\Http\Controllers\Dashboard\RatingsController;
use App\Http\Controllers\Dashboard\SectionsController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CoursesController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InstructorsController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\TestimonialsController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/{email?}', [ContactController::class, 'sendEmail'])->name('home'); //->middleware('');
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home'); //->middleware('');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send-email-message', [ContactController::class, 'sendEmail'])->name('send.email.message');
    Route::get('/pages/{course:slug}/coursesDetails', [CoursesController::class, 'show'])->name('pages.courseDetail');
    Route::view('/pages/featcures', 'front.pages.feature')->name('pages.features');
    Route::get('/instructors', [InstructorsController::class, 'index'])->name('pages.instructors');
    Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('pages.testimonials');
    Route::post('/courses/{course}/send-comment', [CommentController::class, 'store'])->name('course.comment');
    Route::view('/send-email-messages', 'sendEmail', ['email' => ['from' => 'ali.waked@gmail.com', 'name' => 'ali waked', 'subject' => 'bla lba lbalba', 'message' => 'akjdfkajsdfkjasdlkjfalkdjflkajds asdkfjlk asdfj asdf asdjflkas dfkjasdklfj ']]);
});

Route::group([
    'middleware' => ['auth:instructor'],
    'as' => 'dashboard.instructor.',
    'prefix' => '/instructor/dashboard',
], function () {
    // Route::view('/', 'dashboard.instructor.index')->name('index')->middleware(['auth:instructor']);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::resource('/courses', CoursesControllr::class)->except('show')->names('course');
    Route::get('/courses/{course:slug}', [CoursesControllr::class, 'show'])->name('course.show');
    Route::resource('/categories', CategoriesController::class)->names('category');
    // Route::get('/courses/download/Attachment', [CoursesControllr::class, 'downloadAttachment'])->name('course.download');
});
Route::group([
    'middleware' => ['auth:admin'],
    'as' => 'dashboard.',
    'prefix' => '/admin/dashboard/',

], function () {
    // Route::view('/', 'dashboard.instructor.index')->name('index');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/instructor', [InstrctorController::class, 'index'])->name('instructor.index');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    // Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::resource('/courses', CoursesControllr::class)->except('show', 'edit')->names('course');
    Route::get('/courses/{course:slug}/edit', [CoursesControllr::class, 'edit'])->name('course.edit');
    Route::get('/courses/{course:slug}', [CoursesControllr::class, 'show'])->name('course.show');
    Route::get('/feedbacks', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::put('/feedbacks/{testimonial}/update', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/feedbacks/{testimonial}/delete', [TestimonialController::class, 'destroy'])->name('testimonials.delete');
    Route::get('/feedbacks/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::resource('/categories', CategoriesController::class)->names('category');
    Route::get('/course/{course:slug}/section/edit', [SectionsController::class, 'edit'])->name('course.section.edit');
    Route::put('/course/{course:slug}/section/update', [SectionsController::class, 'update'])->name('course.section.update');
    Route::get('/course/{course:slug}/section/create', [SectionsController::class, 'create'])->name('course.section.create')->middleware('auth:admin,instructor');
    Route::post('/course/{course:slug}/section/store', [SectionsController::class, 'store'])->name('course.section.store');
});
Route::get('/courses/download/Attachment', [CoursesControllr::class, 'downloadAttachment'])->name('dashboard.course.download');
Route::group([
    'middleware' => ['auth:web', 'verified'],
    'as' => 'student.',
    'prefix' => '/student/dashboard'
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/feedbacks', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/feedbacks/sed-new-feedback', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::get('/feedbacks/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::post('/profile/store', [InformationsController::class, 'store'])->name('profile.store');
    Route::get('/profile/', [InformationsController::class, 'index'])->name('profile.index');
    Route::get('/courses/', [RatingsController::class, 'index'])->name('courses.index');
    Route::put('/courses/{course}/update', [RatingsController::class, 'update'])->name('courses.update');
    Route::post('/feedbacks/sed-new-feedback', [TestimonialController::class, 'store'])->name('testimonials.store');
});
Route::get('/payment/{course}', [PaymentsController::class, 'create'])->name('payment');
Route::post('/payment/{course}/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])->name('payment.intent');
Route::get('/payment/{course}/confirm', [PaymentsController::class, 'confirm'])->name('payment.return');
Route::get('/locale', [LocalizationController::class, 'changeLanguage'])->name('locale');


Route::get('/test', function () {
    $article = Article::first();
    // App::locale('es');
    dd($article->title);
    return view('test');
});
Route::post('/test', function (Request $request) {
    $article_data = [
        'en' => [
            'title'       => $request->input('en_title'),
            'full_text' => $request->input('en_full_text')
        ],
        'es' => [
            'title'       => $request->input('es_title'),
            'full_text' => $request->input('es_full_text')
        ],
    ];

    // Now just pass this array to regular Eloquent function and Voila!    
    Article::create($article_data);
    // dd($request->all());
    return back()->with('success', 'create new seccssflly');
});
