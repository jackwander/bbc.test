<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Bank;
use App\Branch;
use App\Location;
use App\User;
use App\Userbranch;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
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
        $check_id = Auth::id();
        $user = User::find($check_id);
        if ($user->position>0) {
          return redirect('/')->with('error','Unauthorized Access');
        }        
        return view('settings.users.index');        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userdata()
    {
        $users = User::orderBy('lname','asc')->where('position','>',0)->get();
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="users/'.$user->id.'" class="btn btn-xs btn-primary"><i class="fas fa-search"></i>View</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
        if ($user->position>0) {
          return redirect('/')->with('error','Unauthorized Access');
        }        
        $id = Auth::id();
        $user = User::find($id);
        return view('settings.users.create');
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
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $assignedB = count(DB::table('userbranches')->where([['user_id','=',$user->id]])->get());
        return view('settings.users.show')->with(['user'=>$user,'assignedB'=>$assignedB]);        
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
        $check_id = Auth::id();
        $log_user = User::find($check_id);
        if ($log_user->position > 0 OR $check_id != $log_user->id) {
          return redirect('/')->with('error','Unauthorized Access');
        }
        $user = User::find($id);
        $user->delete();

        return redirect('/settings/users/')->with('success',$user->fname.' '.$user->lname.' Removed');
    }
}
