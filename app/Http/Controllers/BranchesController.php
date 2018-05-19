<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bank;
use App\Branch;
use App\Location;

class BranchesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth',['except'=>['index','show']]);
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('city','asc')->paginate(10);
        return view('settings.branches.index')->with('locations',$locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pickBank($location_id)
    {
        $location = Location::find($location_id);
        $banks = Bank::orderBy('fullname','asc')->paginate(10);
        return view('settings.branches.banks')->with(['location'=>$location,'banks'=>$banks]);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBranches($location_id,$bank_id)
    {
        $location = Location::find($location_id);
        $bank = Bank::find($bank_id);
        $branches = DB::table('branches')->where(['bank_id'=>$bank_id,'location_id'=>$location_id])->paginate(10);

        return view('settings.branches.branches')->with(['location'=>$location,'bank'=>$bank,'branches'=>$branches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($location_id, $bank_id)
    {
        //
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
          'branch'=>'required'
        ]);
      //Create Branch
      $branch = new Branch;
      $branch->branch_name = $request->input('branch');
      $branch->location_id = $request->input('location_id');
      $branch->bank_id = $request->input('bank_id');
      $branch->status = 1;
      $branch->save();

      return redirect('settings/branches/locations/'.$request->input('location_id').'/banks/'.$request->input('bank_id'))->with('success',$request->input('branch').' Added');      
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
        //
    }
}
