<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    public function index(){
        $updates = Blog::orderBy('id', 'desc')->where('status', true)->paginate(5);
        return view('user.updates.index', compact('updates'));
    }
}
