<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    public function index(){
        $alerts = Alert::orderBy('id', 'desc')->where('status', true)->paginate(5);
        return view('user.alerts.index', compact('alerts'));
    }
}
