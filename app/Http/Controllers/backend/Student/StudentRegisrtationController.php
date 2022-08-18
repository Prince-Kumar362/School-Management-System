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
use PDF;
use MPDF;

class StudentRegisrtationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=StudentClass::all();
        $years=StudentYear::all();

        $year_id=StudentYear::orderBy('id','asc')->first()->id;
        $class_id=StudentClass::orderBy('id','asc')->first()->id;
        $datas=AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
        return view('backend.Student.Registration.index',compact('datas','classes','years','class_id','year_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=StudentClass::all();
        $years=StudentYear::all();
        $groups=StudentGroup::all();
        $shifts=StudentShift::all();
        return view('backend.Student.Registration.add',compact('classes','years','groups','shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear=StudentYear::find($request->year_id)->name;
            $student=User::where('usertype','student')->orderBy('id','DESC')->first();

            if($student==null){
                $firstReg=0;
                $studentId=$firstReg+1;
                if($studentId<10){
                    $id_no='000'.$studentId;
                }elseif($studentId<100){
                    $id_no='00'.$studentId;
                }elseif($studentId<1000){
                    $id_no='0'.$studentId;
                }elseif($studentId<10000){
                    $id_no=$studentId;
                }
            }else{
                $student=User::where('usertype','Student')->orderBy('id','DESC')->first()->id;
                $studentId=$student+1;
                if($studentId<10){
                    $id_no='000'.$studentId;
                }elseif($studentId<100){
                    $id_no='00'.$studentId;
                }elseif($studentId<1000){
                    $id_no='0'.$studentId;
                }elseif($studentId<10000){
                    $id_no=$studentId;
                }
            }

            $final_id_no=$checkYear.$id_no;

            $user=new User();
            $code=rand(0000,9999);
            $user->id_number=$final_id_no;
            $user->password=bcrypt($code);
            $user->usertype='Student';
            $user->code=$code;
            $user->name=$request->name;
            $user->father_name=$request->father_name;
            $user->mother_name=$request->mother_name;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=$request->dob;
            if($request->file('image')){
                $file=$request->file('image');
                $file_name=date('YmdHis').$file->getClientOriginalName();
                $file->move(public_path('upload/student_image'),$file_name);
                $user['image']=$file_name;
            }
            $user->save();

            //Assign Student 
            $assign_student=new AssignStudent();
            $assign_student->student_id=$user->id;
            $assign_student->year_id=$request->year_id;
            $assign_student->class_id=$request->class_id;
            $assign_student->group_id=$request->group_id;
            $assign_student->shift_id=$request->shift_id;
            $assign_student->save();

            //discount Student
            $discount_student=new DiscountStudent();
            $discount_student->assign_student_id=$assign_student->id;
            $discount_student->fee_category_id=1;
            $discount_student->discount=$request->discount;
            $discount_student->save();
        });
        $notification=array(
            'message'=>'Student Registration Save Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.registration.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $classes=StudentClass::all();
        $years=StudentYear::all();

        $year_id=$request->year_id;
        $class_id=$request->class_id;
        $datas=AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
        return view('backend.Student.Registration.index',compact('datas','classes','years','class_id','year_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($student_id)
    {
        $classes=StudentClass::all();
        $years=StudentYear::all();
        $groups=StudentGroup::all();
        $shifts=StudentShift::all();

        $data=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    //    dd($data->toArray());
        return view('backend.Student.Registration.edit',compact('classes','years','groups','shifts','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id)
    {
        $user= User::find($student_id);
        $user->usertype='Student';
        $user->name=$request->name;
        $user->father_name=$request->father_name;
        $user->mother_name=$request->mother_name;
        $user->mobile=$request->mobile;
        $user->address=$request->address;
        $user->gender=$request->gender;
        $user->religion=$request->religion;
        $user->dob=$request->dob;
        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('upload/student_image'.$user->image));
            $file_name=date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/student_image'),$file_name);
            $user['image']=$file_name;
        }
        $user->save();
        //Assign Student 
        $assign_student= AssignStudent::where('student_id',$student_id)->first();
        $assign_student->year_id=$request->year_id;
        $assign_student->class_id=$request->class_id;
        $assign_student->group_id=$request->group_id;
        $assign_student->shift_id=$request->shift_id;
        $assign_student->save();

        //discount Student
        $discount_student= DiscountStudent::where('assign_student_id',$request->id)->first();
        $discount_student->fee_category_id='1';
        $discount_student->discount=$request->discount;
        $discount_student->save();

        $notification=array(
            'message'=>'Student Registration Update Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.registration.view')->with($notification);
    }



    public function add_promotion($student_id)
    {
        $classes=StudentClass::all();
        $years=StudentYear::all();
        $groups=StudentGroup::all();
        $shifts=StudentShift::all();

        $data=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    //    dd($data->toArray());
        return view('backend.Student.Registration.promotion',compact('classes','years','groups','shifts','data'));
    }



    function promotion(Request $request, $student_id){
        $user= User::find($student_id);
        $user->usertype='Student';
        $user->name=$request->name;
        $user->father_name=$request->father_name;
        $user->mother_name=$request->mother_name;
        $user->mobile=$request->mobile;
        $user->address=$request->address;
        $user->gender=$request->gender;
        $user->religion=$request->religion;
        $user->dob=$request->dob;
        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('upload/student_image'.$user->image));
            $file_name=date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('upload/student_image'),$file_name);
            $user['image']=$file_name;
        }
        $user->save();
        //Assign Student 
        $assign_student=new AssignStudent();
        $assign_student->student_id=$student_id;
        $assign_student->year_id=$request->year_id;
        $assign_student->class_id=$request->class_id;
        $assign_student->group_id=$request->group_id;
        $assign_student->shift_id=$request->shift_id;
        $assign_student->save();

        //discount Student
        $discount_student=new DiscountStudent();
        $discount_student->assign_student_id=$assign_student->id;
        $discount_student->fee_category_id=1;
        $discount_student->discount=$request->discount;
        $discount_student->save();

        $notification=array(
            'message'=>'Student Promote Successfully!!',
            'alert-type'=>'success'
        );
        return redirect()->route('student.registration.view')->with($notification);
    }

    function details($student_id){
        $data=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        // $pdf = PDF::loadView('backend.Student.Registration.pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
        // $pdf = PDF::loadView('backend.Student.Registration.pdf',$data);
        // $pdf->getMpdf()->AddPage(); 
        // return $pdf->loadView('pdf.document',$data);
        // $pdf = mpdf::loadloadHTML('backend.Student.Registration.pdf', $data);
        return view('backend.Student.Registration.pdf',compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        //
    }

}
