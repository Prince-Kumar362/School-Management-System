<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_subject extends Model
{
    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
    public function SchoolSubject(){
        return $this->belongsTo(SchoolSubject::class,'subject_id','id');
    }
    
}