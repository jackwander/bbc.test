<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Bank;

class BanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('created_at','desc')->paginate(10);
        return view('settings.banks.index')->with('banks',$banks);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'fullname'=>'required',
          'shortname'=>'required'
        ]);

      //Create Bank
      $bank = new Bank;
      $bank->fullname = $request->input('fullname');
      $bank->shortname = strtoupper($request->input('shortname'));
      $bank->save();

      return redirect('/settings/banks')->with('success', $bank->fullname.' is Added');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return view('settings.banks.edit')->with('bank',$bank);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'fullname'=>'required',
          'shortname'=>'required'
        ]);

      //Create Bank
      $bank = Bank::find($id);
      $bank->fullname = $request->input('fullname');
      $bank->shortname = strtoupper($request->input('shortname'));
      $bank->save();

      return redirect('/settings/banks')->with('success',$bank->fullname.' is Updated');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return redirect('/settings/banks')->with('success',$bank->fullname.' Removed');
    }
}
