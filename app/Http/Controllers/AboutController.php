<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
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
        $datas=About::all();
        return view('admin.about.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=>'required|min:5|max:255',
            'body'=>'required|min:5',
            'description'=>'required|min:5',
        ]);

        $image= new About;
        $image->title=$request->title;
        $image->body=$request->body;
        $image->description=$request->description;
        $image->save();
        $notification=array(
            'message'=>'About US Save Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.about'))->with($notification);
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
        $about=About::find($id);
        return view('admin.about.edit',compact('about'));
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
        $validated = $request->validate([
            'title'=>'required|min:5|max:255',
            'body'=>'required|min:5',
            'description'=>'required|min:5',
        ]);

        $image=About::find($id);
        $image->title=$request->title;
        $image->body=$request->body;
        $image->description=$request->description;
        $image->update();
        $notification=array(
            'message'=>'About US Update Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.about'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        About::find($id)->delete();
        $notification=array(
            'message'=>'About US Delete Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.about'))->with($notification);
    }
}
