<?php

namespace App\Http\Controllers\backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Support\Facades\DB;

class StudentRollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years=StudentYear::All();
        $classes=StudentClass::All();
        return view('backend.Student.Roll.index',compact('years','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        if($request->student_id!=null){
            for($i=0;$i< count($request->student_id);$i++){
                AssignStudent::where('year_id',$year_id)
                ->where('class_id',$class_id)
                ->where('student_id',$request->student_id[$i])
                ->update(['roll'=>$request->roll[$i]]);
            }
        }else{
            $notification=array(
                'message'=>'Sorry there are no student',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        $notification=array(
            'message'=>'Well Done Roll Generated Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.roll.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $datas=AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        // return $datas;
        return response()->json($datas);
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
