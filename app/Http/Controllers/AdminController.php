<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // view admin dashboard page
    public function index(){
        return view('backend.admin-dashboard');
    }
}
