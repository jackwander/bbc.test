<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
      $title = "Welcome to Bacolod Bank Checker!";
      return view('pages.index', compact('title'));
    }
}
