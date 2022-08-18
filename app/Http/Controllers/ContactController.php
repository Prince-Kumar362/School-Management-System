<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
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
        $datas=Contact::all();
        return view('admin.contact.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.add');
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
            'location'=>'required|min:5|max:255',
            'mobile'=>'required|min:10',
            'email'=>'required|email',
        ]);
        
        $image= new Contact;
        $image->location=$request->location;
        $image->mobile=$request->mobile;
        $image->email=$request->email;
        $image->save();
        $notification=array(
            'message'=>'About US Save Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.contact'))->with($notification);
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
        $contact=Contact::find($id);
        return view('admin.contact.edit',compact('contact'));
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
            'location'=>'required|min:5|max:255',
            'mobile'=>'required|min:10',
            'email'=>'required|email',
        ]);

        $image=Contact::find($id);
        $image->location=$request->location;
        $image->mobile=$request->mobile;
        $image->email=$request->email;
        $image->update();
        $notification=array(
            'message'=>'Contact US Update Successfully!!',
            'alert-type'=>'success'
        );
            return Redirect(route('home.contact'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
        $notification=array(
            'message'=>'Contact US Delete Successfully!!',
            'alert-type'=>'success'
        );
        return Redirect(route('home.contact'))->with($notification);
    }
}
