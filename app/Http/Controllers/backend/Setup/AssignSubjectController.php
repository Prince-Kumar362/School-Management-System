<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\Assign_subject;

class AssignSubjectController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas=Assign_subject::all();
        $datas=Assign_subject::select('class_id')->groupBy('class_id')->get();
        return view('backend.Setup.Assign_subject.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=StudentClass::all();
        $subjects=SchoolSubject::all();
        return view('backend.Setup.Assign_subject.add',compact('classes','subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $countClass=count($request->subject_id);
        if($countClass !=NULL){
            for($i=0;$i<$countClass;$i++){
                $fee_amount=new Assign_subject();
                $fee_amount->class_id=$request->class_id;
                $fee_amount->subject_id=$request->subject_id[$i];
                $fee_amount->full_mark=$request->full_mark[$i];
                $fee_amount->pass_mark=$request->pass_mark[$i];
                $fee_amount->subjective_mark=$request->subjective_mark[$i];
                $fee_amount->save();
            }
        }
        $notification=array(
            'message'=>'Assign Subject Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('assign.subject.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas=Assign_subject::where('class_id',$id)->orderBy('subject_id','asc')->get();
        return view('backend.Setup.Assign_subject.show',compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Assign_subject::where('class_id',$id)->orderBy('class_id','asc')->get();
        $subjects=SchoolSubject::all();
        $classes=StudentClass::all();
       return view('backend.Setup.Assign_subject.edit',compact('data','subjects','classes'));
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
        if($request->subject_id==Null){
            $notification=array(
                'message'=>'Sorry You do Select any Subject Marks!!',
                'alert-type'=>'error'
            );
            return redirect()->route('assign.subject.edit',$id)->with($notification);
        }else{
            Assign_subject::where('class_id',$id)->delete();
            $countClass=count($request->subject_id);
            for($i=0;$i<$countClass;$i++){
                $fee_amount=new Assign_subject();
                $fee_amount->class_id=$request->class_id;
                $fee_amount->subject_id=$request->subject_id[$i];
                $fee_amount->full_mark=$request->full_mark[$i];
                $fee_amount->pass_mark=$request->pass_mark[$i];
                $fee_amount->subjective_mark=$request->subjective_mark[$i];
                $fee_amount->save();
            }
            $notification=array(
                'message'=>'Assign Subject Update Successfully!!',
                'alert-type'=>'success'
            );
            return redirect()->route('assign.subject.view')->with($notification);
        }
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
