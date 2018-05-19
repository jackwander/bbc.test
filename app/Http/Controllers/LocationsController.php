<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Location;

class LocationsController extends Controller
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
        $locations = Location::orderBy('city','asc')->paginate(10);
        return view('settings.locations.index')->with('locations',$locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.locations.create');
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
          'city'=>'required',
          'shortname'=>'required',
          'body'=>'required',
          'cover_image'=>'image|nullable|max:1999'
        ]);
      
      //handle file upload
      if ($request->hasFile('cover_image')) {
          // Get filename with extention
          $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
          // Get just filename
          $filename = $request->input('city');
          // Get just ext
          $extension = $request->file('cover_image')->getClientOriginalExtension();
          // filename to store
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload image
          $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
      } else {
          $fileNameToStore = 'noimage.jpg';
      }

      //Create Location
      $location = new Location;
      $location->city = $request->input('city');
      $location->shortname = $request->input('shortname');
      $location->body = $request->input('body');
      $location->cover_image = $fileNameToStore;
      $location->save();

      return redirect('/settings/locations')->with('success','New Location Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        return view('settings.locations.show')->with('location',$location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);

        // Check user if correct
        // if (auth()->user()->id != $location->user_id) {
        //     return redirect('/posts')->with('error','Unauthorized Page');        
        // }
    
        return view('settings.locations.edit')->with('location',$location);
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
            'city'=>'required',
            'shortname'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
          ]);
        //Find Data
        $location = Location::find($id);

        //handle file upload
        if ($request->hasFile('cover_image')) {
            Storage::delete('public/cover_images/'.$location->cover_image);

            // Get filename with extention
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = $request->input('city');
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        //Create Location
        $location->city = $request->input('city');
        $location->shortname = $request->input('shortname');
        $location->body = $request->input('body');        
        if ($request->hasFile('cover_image')) {
            $location->cover_image = $fileNameToStore;        
        }        
        $location->save();

        return redirect('/settings/locations/')->with('success',$request->input('city').' Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        
        // Check user if correct
        // if (auth()->user()->id != $location->user_id) {
        //     return redirect('/posts')->with('error','Unauthorized Page');        
        // }

        if ($location->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$location->cover_image);
        }

        $location->delete();
        return redirect('/settings/locations')->with('success', $location->city.' Removed');  
    }
}
