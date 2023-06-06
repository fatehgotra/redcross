<?php

namespace App\Http\Controllers\Hq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hq');
    }

    public function index()
    {
        return view('hq.dashboard.dashboard');
    }
}
