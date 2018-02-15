<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
class HomeController extends AdminController
{
    public  function home() {

       // dd(Sentinel::getUser());
        return view('backend.home');

    }



}
