<?php

namespace App\Http\Controllers\DivisionManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:division-manager');
    }

    public function index()
    {
        return view('division-manager.dashboard.dashboard');
    }
}
