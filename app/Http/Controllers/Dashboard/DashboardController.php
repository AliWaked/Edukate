<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{
    public function index()
    {
        if (Config::get('fortify.guard') == 'admin') {
            return view('dashboard.admin.index');
        } elseif (Config::get('fortify.guard') == 'instructor') {
            return view('dashboard.instructor.index');
        }
        return view('dashboard.student.index');
    }
}
