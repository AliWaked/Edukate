<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstrctorController extends Controller
{
    public function index(Request $request)
    {
        // dd(Instructor::filter($request->filter)->first(),$request->filter);
        return view('dashboard.admin.instructors', [
            'instructors' => Instructor::filter($request->filter)->paginate(),
            'filter' => $request->filter ?? '',
        ]);
    }
}
