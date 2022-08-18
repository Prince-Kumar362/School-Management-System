<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=Designation::all();
        return view('backend.Setup.Designation.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.Designation.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'required|min:1|unique:school_subjects,name',
        ]);
        $student=new Designation();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'Designation Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('designation.view')->with($notification);
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
        $data=Designation::find($id);
        return view('backend.Setup.Designation.edit',compact('data'));
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
        $validateData=$request->validate([
            'name'=>'required|min:1|unique:school_subjects,name',
        ]);
        $class=Designation::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'Designation Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=Designation::find($id);
        $class->delete();
        $notification=array(
            'message'=>'Designation Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }
}
