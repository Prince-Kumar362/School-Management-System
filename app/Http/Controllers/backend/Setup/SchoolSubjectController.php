<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=SchoolSubject::all();
        return view('backend.Setup.School_subject.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Setup.School_subject.add');
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
        $student=new SchoolSubject();
        $student->name=$request->name;
        $student->save();

        $notification=array(
            'message'=>'School Subject Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
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
        $data=SchoolSubject::find($id);
        return view('backend.Setup.School_subject.edit',compact('data'));
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
        $class=SchoolSubject::find($id);
        $class->name=$request->name;
        $class->save();

        $notification=array(
            'message'=>'School Subject Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class=SchoolSubject::find($id);
        $class->delete();
        $notification=array(
            'message'=>'School Subject Delete Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('school.subject.view')->with($notification);
    }
}
