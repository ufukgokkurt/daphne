<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class AdminController extends Controller
{


 // Custom 403 page
    public function show_403() {
        return response(view('backend.error.403'), 403);
    }






}
