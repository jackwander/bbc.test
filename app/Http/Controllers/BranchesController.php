<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bank;
use App\Branch;
use App\Location;
use App\User;
use App\Userbranch;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','showBranches','pickBank']]);
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
        $users = User::orderBy('lname','asc')->where('position', '>', 0)->get();
        $branches = DB::table('branches')->orderBy('branch_name','ASC')->where(['bank_id'=>$bank_id,'location_id'=>$location_id])->paginate(10);

        return view('settings.branches.branches')->with(['location'=>$location,'bank'=>$bank,'branches'=>$branches,'users'=>$users]);
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
          return redirect('/branches/locations/'.$location_id.'/banks/'.$bank_id)->with('error',$branch->branch_name.' branch is already assigned to '.$user->fname.' '.$user->lname.'.');
        }

        $userbranch = new Userbranch;
        $userbranch->branch_id = $branch_id;
        $userbranch->user_id = $user_id;
        $userbranch->save();

        return redirect('/branches/locations/'.$location_id.'/banks/'.$bank_id)->with('success', $branch->branch_name.' branch is assigned to '.$user->fname.' '.$user->lname.'.');
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
          'branch'=>'required',
          'address'=>'required',
          'contactnum'=>'required',          
        ]);
      //Create Branch
      $branch = new Branch;
      $branch->branch_name = $request->input('branch');
      $branch->address = $request->input('address');
      $branch->contactnum = $request->input('contactnum');      
      $branch->location_id = $request->input('location_id');
      $branch->bank_id = $request->input('bank_id');
      $branch->status = 1;
      $branch->save();

      return redirect('branches/locations/'.$request->input('location_id').'/banks/'.$request->input('bank_id'))->with('success',$request->input('branch').' Added');      
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $branch_id, $status
     * @return \Illuminate\Http\Response
     */
    public function editBranchStatus($status, $branch_id)
    {
      // echo $status.' '.$branch_id;
      $branch = Branch::find($branch_id);
      $branch->status = $status;
      $branch->save();
      return redirect('/branches/locations/'.$branch->location_id.'/banks/'.$branch->bank_id)->with('success',$branch->branch_name.' Updated');
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
      $this->validate($request, [
          'branch'=>'required',
          'address'=>'required',
          'contactnum'=>'required',
        ]);      
      
      $branch = Branch::find($id);
      $branch->branch_name = $request->input('branch');
      $branch->address = $request->input('address');
      $branch->contactnum = $request->input('contactnum');      
      $branch->save();
      return redirect('/branches/locations/'.$branch->location_id.'/banks/'.$branch->bank_id)->with('success',$branch->branch_name.' Updated');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete();

        return redirect('/branches/locations/'.$branch->location_id.'/banks/'.$branch->bank_id)->with('success',$branch->branch_name.' Removed');
    }
}
