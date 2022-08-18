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
use App\Models\FeeCategoryAmount;
use Illuminate\Support\Facades\DB;
use App\Models\ExamType;

class StudentExamFeeController extends Controller
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
        $examTypes=ExamType::All();
        return view('backend.Student.Exam_fee.index',compact('years','classes','examTypes'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
            $year_id = $request->year_id;
            $class_id = $request->class_id;
            $exam_type_id = $request->exam_type_id;
            if ($year_id !='') {
                $where[] = ['year_id','like',$year_id.'%'];
            }
            if ($class_id !='') {
                $where[] = ['class_id','like',$class_id.'%'];
            }
            $allStudent = AssignStudent::with(['discount'])->where($where)->get();
            // dd($allStudent);
            $html['thsource']  = '<th>SL</th>';
            $html['thsource'] .= '<th>ID No</th>';
            $html['thsource'] .= '<th>Student Name</th>';
            $html['thsource'] .= '<th>Roll No</th>';
            $html['thsource'] .= '<th>Exam Type Fee</th>';
            $html['thsource'] .= '<th>Discount </th>';
            $html['thsource'] .= '<th>Student Fee </th>';
            $html['thsource'] .= '<th>Action</th>';
   
   
            foreach ($allStudent as $key => $v) {
                $registrationfee = FeeCategoryAmount::where('fee_category_id','4')->where('class_id',$v->class_id)->first();
                $color = 'success';
                $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['student']['id_number'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'</td>';
                $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';
                
                $originalfee = $registrationfee->amount;
                $discount = $v['discount']['discount'];
                $discounttablefee = $discount/100*$originalfee;
                $finalfee = (float)$originalfee-(float)$discounttablefee;
   
                $html[$key]['tdsource'] .='<td>'.$finalfee.'$'.'</td>';
                $html[$key]['tdsource'] .='<td>';
                $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'">Fee Slip</a>';
                $html[$key]['tdsource'] .= '</td>';
   
            }  
           return response()->json(@$html);
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

    public function payslip(Request $request){
        $student_id=$request->student_id;
        $class_id=$request->class_id;
        $exam_type=ExamType::where('id',$request->exam_type_id)->first()['name'];
        $data=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
        return view('backend.Student.Exam_fee.print',compact('data','exam_type'));
    }
}
