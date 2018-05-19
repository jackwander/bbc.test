<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Bank;

class BanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
          'shortname'=>'required',
          'cover_image'=>'image|nullable|max:1999'          
        ]);

      //handle file upload
      if ($request->hasFile('cover_image')) {
          // Get filename with extention
          $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = $request->input('shortname');
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      } else {
          $fileNameToStore = 'noimage.jpg';
      }

      //Create Bank
      $bank = new Bank;
      $bank->fullname = $request->input('fullname');
      $bank->shortname = strtoupper($request->input('shortname'));
      $bank->cover_image = $fileNameToStore;      
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
          'shortname'=>'required',
          'cover_image'=>'image|nullable|max:1999'          
        ]);
      $bank = Bank::find($id);

      //handle file upload
      if ($request->hasFile('cover_image')) {
          Storage::delete('public/cover_images/'.$bank->cover_image);

          // Get filename with extention
          $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = $request->input('shortname');
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      }

      //Create Bank
      $bank->fullname = $request->input('fullname');
      $bank->shortname = strtoupper($request->input('shortname'));
      if ($request->hasFile('cover_image')) {
          $location->cover_image = $fileNameToStore;        
      }          
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
