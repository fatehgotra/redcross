<?php

namespace App\Http\Controllers\BranchLevel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:branch-level');
    }

    public function index()
    {
        return view('branch-level.dashboard.dashboard');
    }
}
