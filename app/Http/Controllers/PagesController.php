<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;

class PagesController extends Controller
{
    public function index() {
      $banks = Bank::orderBy('fullname','ASC')->get();
      $title = "Welcome to Negros Bank Checker!";
      return view('pages.index')->with(['banks'=>$banks,'title'=>$title]);
    }
}
