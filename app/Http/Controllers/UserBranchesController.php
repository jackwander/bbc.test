<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bank;
use App\Branch;
use App\Location;
use App\User;
use App\Userbranch;

class UserBranchesController extends Controller
{
    /**m
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usb = Userbranch::all();
        return view('settings.userbranches.index')->with('usb',$usb);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::orderBy('city','ASC')->get();
        $banks = Bank::orderBy('fullname','ASC')->get();
        $users = User::where('position','>',0)->orderBy('lname','ASC')->get();;
        return view('settings.userbranches.create')->with(['locations'=>$locations,'banks'=>$banks,'users'=>$users]);
    }

    // public function findBanks(Request $request)
    // {
    //     $data 
    // }
    public function findBranches(Request $request)
    {
        $data = Branch::select('branch_id','branch_name')->where(['location_id'=>$request->loc_id,'bank_id'=>$request->bank_id])->orderBy('branch_name','ASC')->get();

        return response()->json($data);
    } 
   public function findUserBranches(Request $request)
    {   
        $user_id = DB::table('userbranches')->select('user_id')->where('branch_id',$request->branch_id)->get();
        $data = [];
        
        if(count($user_id)>0){
            $data += User::select('fname','mname','lname','id')->orderBy('lname','ASC')->where([['id','!=',$user_id],['position','>',0]])->get();
        }else {
            $data = User::select('fname','mname','lname','id')->orderBy('lname','ASC')->where('position','>',0)->get();
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignBranch(Request $request)
    {
        $location_id = $request->input('location_id');
        $bank_id = $request->input('bank_id');
        $branch_id = $request->input('branch_id');
        $user_id = $request->input('user_id');
        $check = DB::table('userbranches')->where(['branch_id'=>$branch_id,'user_id'=>$user_id])->get();
        $branch = DB::table('branches')->where(['branch_id'=>$branch_id])->first();
        $user = DB::table('users')->where(['id'=>$user_id])->first();
        
        if (count($check)>0) {
          return redirect('/settings/userbranches')->with('error',$branch->branch_name.' branch is already assigned to '.$user->fname.' '.$user->lname.'.');
        }

        $userbranch = new Userbranch;
        $userbranch->branch_id = $branch_id;
        $userbranch->user_id = $user_id;
        $userbranch->save();

        return redirect('/settings/userbranches')->with('success', $branch->branch_name.' branch is assigned to '.$user->fname.' '.$user->lname.'.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $us = Userbranch::find($id);
      $name = DB::table('users')->where(['id'=>$us->user_id])->value('fname').' '.DB::table('users')->where(['id'=>$us->user_id])->value('lname');
      $location = DB::table('locations')->where('location_id', DB::table('branches')->where('branch_id',$us->branch_id)->value('location_id'))->value('city');
      $branch = DB::table('branches')->where('branch_id',$us->branch_id)->value('branch_name');        
      $us->delete();
      return redirect('/settings/userbranches')->with('success','Unassigned '.$location.' '.$branch.' branch to '.$name);
    }
}
