<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\multipleimageController;
use Illuminate\Support\Facades\DB;
use App\Models\MultipleImage;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProfileController;

use App\Http\Controllers\backend\Setup\StudentClassController;
use App\Http\Controllers\backend\Setup\StudentYearController;
use App\Http\Controllers\backend\Setup\StudentGroupController;
use App\Http\Controllers\backend\Setup\StudentShiftController;
use App\Http\Controllers\backend\Setup\FeeCateroryController;
use App\Http\Controllers\backend\Setup\FeeCategoryAmountController;
use App\Http\Controllers\backend\Setup\ExamTypeController;
use App\Http\Controllers\backend\Setup\SchoolSubjectController;
use App\Http\Controllers\backend\Setup\AssignSubjectController;
use App\Http\Controllers\backend\Setup\DesignationController;

use App\Http\Controllers\backend\Student\StudentRegisrtationController;
use App\Http\Controllers\backend\Student\StudentRollController;
use App\Http\Controllers\backend\Student\StudentRegiststrationFeeController;
use App\Http\Controllers\backend\Student\StudentMonthlyFeeController;
use App\Http\Controllers\backend\Student\StudentExamFeeController;

use App\Http\Controllers\backend\Employee\EmployeeRegisrtationController;
use App\Http\Controllers\backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\backend\Employee\MonthlySalaryController;

use App\Http\Controllers\backend\Account\AccountSalaryController;
use App\Http\Controllers\backend\Account\OtherCostController;
use App\Http\Controllers\backend\Account\StudentFeeController;

use App\Http\Controllers\backend\Marks\GradeController;
use App\Http\Controllers\backend\Marks\MarksController;

use App\Http\Controllers\backend\DefaultController;

use App\Http\Controllers\backend\Report\AttenReportController;
use App\Http\Controllers\backend\Report\MarkSheetController;
use App\Http\Controllers\backend\Report\ProfiteController;
use App\Http\Controllers\backend\Report\ResultReportController;

use App\Http\Controllers\SendEmailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $StudentClass = DB::table('student_classes')->count();
        $StudentGroup = DB::table('student_groups')->count();
        $StudentShift = DB::table('student_shifts')->count();
        $users = DB::table('users')->count();
        return view('admin.index', compact('StudentClass', 'StudentGroup', 'StudentShift', 'users'));
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::view('calender', 'calender');

Route::get('/', function () {
    $sliders = DB::table('sliders')->get();
    $abouts = DB::table('abouts')->first();
    $images = MultipleImage::all();
    return view('page.home', compact('sliders', 'abouts', 'images'));
});
Route::get('/about', function () {
    $abouts = DB::table('abouts')->first();
    return view('page.about', compact('abouts'));
});
Route::get('/contact', function () {
    $contacts = DB::table('contacts')->first();
    return view('page.contact', compact('contacts'));
});
Route::get('/portfolio', function () {
    $images = MultipleImage::all();
    return view('page.portfolio', compact('images'));
});
Route::get('/service', function () {
    $contacts = DB::table('contacts')->first();
    return view('page.services', compact('contacts'));
});

Route::group(['middleware' => 'auth'], function () {
    //Slider All route
    Route::GET('Slider/All', [SliderController::class, 'index'])->name('home.slider');
    Route::GET('Slider/Add', [SliderController::class, 'create'])->name('Slider.Add');
    Route::POST('Slider/Add', [SliderController::class, 'store'])->name('Slider.Add');
    Route::get('/Slider/edit/{id}', [SliderController::class, 'edit']);
    Route::post('Slider/update/{id}', [SliderController::class, 'update']);
    Route::get('/Slider/delete/{id}', [SliderController::class, 'destroy']);

    //About All route
    Route::GET('about/All', [AboutController::class, 'index'])->name('home.about');
    Route::GET('about/Add', [AboutController::class, 'create'])->name('about.Add');
    Route::POST('about/Add', [AboutController::class, 'store'])->name('about.Add');
    Route::get('/about/edit/{id}', [AboutController::class, 'edit']);
    Route::post('about/update/{id}', [AboutController::class, 'update']);
    Route::get('/about/delete/{id}', [AboutController::class, 'destroy']);

    //Contact All route
    Route::controller(ContactController::class)->group(function () {
        Route::GET('contact/All', 'index')->name('home.contact');
        Route::GET('contact/Add', 'create')->name('contact.Add');
        Route::POST('contact/Add', 'store')->name('contact.Add');
        Route::get('/contact/edit/{id}', 'edit');
        Route::post('contact/update/{id}', 'update');
        Route::get('/contact/delete/{id}', 'destroy');
    });


    //Multiple Image
    Route::GET('multipleImage/All', [multipleimageController::class, 'index'])->name('home.multipleImage');
    Route::GET('multipleImage/Add', [multipleimageController::class, 'create'])->name('multipleImage.Add');
    Route::POST('multipleImage/Add', [multipleimageController::class, 'store'])->name('multipleImage.Add');
    Route::get('/multipleImage/edit/{id}', [multipleimageController::class, 'edit']);
    Route::post('multipleImage/update/{id}', [multipleimageController::class, 'update']);
    Route::get('/multipleImage/delete/{id}', [multipleimageController::class, 'destroy']);

    //user
    Route::controller(UserController::class)->group(function () {
        Route::get('Users/View', 'index')->name('user.view');
        Route::get('Users/Add', 'create')->name('user.add');
        Route::post('Users/Store', 'store')->name('user.store');
        Route::get('Users/Edit/{id}', 'edit')->name('user.edit');
        Route::get('Users/Delete/{id}', 'destroy')->name('user.delete');
        Route::post('Users/Update/{id}', 'update')->name('user.update');
    });

    //user Profile
    Route::prefix('Profile')->group(function () {
        Route::get('/view', [ProfileController::class, 'show'])->name('user.profile');
        Route::get('/Edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::POST('/Edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/Password', [ProfileController::class, 'Change_Password'])->name('password.change');
        Route::POST('/Password', [ProfileController::class, 'Update_Password'])->name('user.password.change');
    });
    //Student class
    Route::prefix('Setups')->group(function () {
        Route::get('/student/class/view', [StudentClassController::class, 'index'])->name('student.class.view');
        Route::get('/student/class/Add', [StudentClassController::class, 'create'])->name('student.class.add');
        Route::post('/student/class/Add', [StudentClassController::class, 'store'])->name('student.class.add');
        Route::get('/student/class/Edit/{id}', [StudentClassController::class, 'edit'])->name('student.class.edit');
        Route::get('/student/class/Delete/{id}', [StudentClassController::class, 'destroy'])->name('student.class.delete');
        Route::post('/student/class/Update/{id}', [StudentClassController::class, 'update'])->name('student.class.update');
    });
    //Student Year
    Route::prefix('Setups')->group(function () {
        Route::get('/student/year/view', [StudentYearController::class, 'index'])->name('student.year.view');
        Route::get('/student/year/Add', [StudentYearController::class, 'create'])->name('student.year.add');
        Route::post('/student/year/Add', [StudentYearController::class, 'store'])->name('student.year.add');
        Route::get('/student/year/Edit/{id}', [StudentYearController::class, 'edit'])->name('student.year.edit');
        Route::get('/student/year/Delete/{id}', [StudentYearController::class, 'destroy'])->name('student.year.delete');
        Route::post('/student/year/Update/{id}', [StudentYearController::class, 'update'])->name('student.year.update');
    });
    //Student Group
    Route::prefix('Setups')->group(function () {
        Route::get('/student/group/view', [StudentGroupController::class, 'index'])->name('student.group.view');
        Route::get('/student/group/Add', [StudentGroupController::class, 'create'])->name('student.group.add');
        Route::post('/student/group/Add', [StudentGroupController::class, 'store'])->name('student.group.add');
        Route::get('/student/group/Edit/{id}', [StudentGroupController::class, 'edit'])->name('student.group.edit');
        Route::get('/student/group/Delete/{id}', [StudentGroupController::class, 'destroy'])->name('student.group.delete');
        Route::post('/student/group/Update/{id}', [StudentGroupController::class, 'update'])->name('student.group.update');
    });
    //Student Shift
    Route::prefix('Setups')->group(function () {
        Route::get('/student/shift/view', [StudentShiftController::class, 'index'])->name('student.shift.view');
        Route::get('/student/shift/Add', [StudentShiftController::class, 'create'])->name('student.shift.add');
        Route::post('/student/shift/Add', [StudentShiftController::class, 'store'])->name('student.shift.add');
        Route::get('/student/shift/Edit/{id}', [StudentShiftController::class, 'edit'])->name('student.shift.edit');
        Route::get('/student/shift/Delete/{id}', [StudentShiftController::class, 'destroy'])->name('student.shift.delete');
        Route::post('/student/shift/Update/{id}', [StudentShiftController::class, 'update'])->name('student.shift.update');
    });
    //Fee Category
    Route::prefix('Setups')->group(function () {
        Route::get('/fee/category/view', [FeeCateroryController::class, 'index'])->name('fee.category.view');
        Route::get('/fee/category/Add', [FeeCateroryController::class, 'create'])->name('fee.category.add');
        Route::post('/fee/category/Add', [FeeCateroryController::class, 'store'])->name('fee.category.add');
        Route::get('/fee/category/Edit/{id}', [FeeCateroryController::class, 'edit'])->name('fee.category.edit');
        Route::get('/fee/category/Delete/{id}', [FeeCateroryController::class, 'destroy'])->name('fee.category.delete');
        Route::post('/fee/category/Update/{id}', [FeeCateroryController::class, 'update'])->name('fee.category.update');
    });
    //Fee Category Amount
    Route::prefix('Setups')->group(function () {
        Route::get('/fee/amount/view', [FeeCategoryAmountController::class, 'index'])->name('fee.amount.view');
        Route::get('/fee/amount/Add', [FeeCategoryAmountController::class, 'create'])->name('fee.amount.add');
        Route::post('/fee/amount/Add', [FeeCategoryAmountController::class, 'store'])->name('fee.amount.add');
        Route::get('/fee/amount/Edit/{id}', [FeeCategoryAmountController::class, 'edit'])->name('fee.amount.edit');
        Route::get('/fee/amount/Delete/{id}', [FeeCategoryAmountController::class, 'destroy'])->name('fee.amount.delete');
        Route::post('/fee/amount/Update/{id}', [FeeCategoryAmountController::class, 'update'])->name('fee.amount.update');
        Route::get('/fee/amount/show/{id}', [FeeCategoryAmountController::class, 'show'])->name('fee.amount.show');
    });
    //Exam type
    Route::prefix('Setups')->group(function () {
        Route::get('/exam/type/view', [ExamTypeController::class, 'index'])->name('exam.type.view');
        Route::get('/exam/type/Add', [ExamTypeController::class, 'create'])->name('exam.type.add');
        Route::post('/exam/type/Add', [ExamTypeController::class, 'store'])->name('exam.type.add');
        Route::get('/exam/type/Edit/{id}', [ExamTypeController::class, 'edit'])->name('exam.type.edit');
        Route::get('/exam/type/Delete/{id}', [ExamTypeController::class, 'destroy'])->name('exam.type.delete');
        Route::post('/exam/type/Update/{id}', [ExamTypeController::class, 'update'])->name('exam.type.update');
    });
    //School Subject
    Route::prefix('Setups')->group(function () {
        Route::get('/school/subject/view', [SchoolSubjectController::class, 'index'])->name('school.subject.view');
        Route::get('/school/subject/Add', [SchoolSubjectController::class, 'create'])->name('school.subject.add');
        Route::post('/school/subject/Add', [SchoolSubjectController::class, 'store'])->name('school.subject.add');
        Route::get('/school/subject/Edit/{id}', [SchoolSubjectController::class, 'edit'])->name('school.subject.edit');
        Route::get('/school/subject/Delete/{id}', [SchoolSubjectController::class, 'destroy'])->name('school.subject.delete');
        Route::post('/school/subject/Update/{id}', [SchoolSubjectController::class, 'update'])->name('school.subject.update');
    });
    //Assign Subject
    Route::prefix('Setups')->group(function () {
        Route::get('/assign/subject/view', [AssignSubjectController::class, 'index'])->name('assign.subject.view');
        Route::get('/assign/subject/Add', [AssignSubjectController::class, 'create'])->name('assign.subject.add');
        Route::post('/assign/subject/Add', [AssignSubjectController::class, 'store'])->name('assign.subject.add');
        Route::get('/assign/subject/Edit/{id}', [AssignSubjectController::class, 'edit'])->name('assign.subject.edit');
        Route::get('/assign/subject/Delete/{id}', [AssignSubjectController::class, 'destroy'])->name('assign.subject.delete');
        Route::post('/assign/subject/Update/{id}', [AssignSubjectController::class, 'update'])->name('assign.subject.update');
        Route::get('/assign/subject/show/{id}', [AssignSubjectController::class, 'show'])->name('assign.subject.show');
    });
    //Designation
    Route::prefix('Setups')->group(function () {
        Route::get('/designation/view', [DesignationController::class, 'index'])->name('designation.view');
        Route::get('/designation/Add', [DesignationController::class, 'create'])->name('designation.add');
        Route::post('/designation/Add', [DesignationController::class, 'store'])->name('designation.add');
        Route::get('/designation/Edit/{id}', [DesignationController::class, 'edit'])->name('designation.edit');
        Route::get('/designation/Delete/{id}', [DesignationController::class, 'destroy'])->name('designation.delete');
        Route::post('/designation/Update/{id}', [DesignationController::class, 'update'])->name('designation.update');
    });
    //Student registration
    Route::prefix('Students')->group(function () {
        Route::get('/registration/view', [StudentRegisrtationController::class, 'index'])->name('student.registration.view');
        Route::get('/registration/Add', [StudentRegisrtationController::class, 'create'])->name('student.registration.add');
        Route::post('/registration/Add', [StudentRegisrtationController::class, 'store'])->name('student.registration.add');
        Route::get('/registration/Edit/{student_id}', [StudentRegisrtationController::class, 'edit'])->name('student.registration.edit');
        Route::get('/registration/Promotion/{student_id}', [StudentRegisrtationController::class, 'add_promotion'])->name('student.registration.add_promotion');
        Route::get('/registration/Delete/{student_id}', [StudentRegisrtationController::class, 'destroy'])->name('student.registration.delete');
        Route::post('/registration/Update/{student_id}', [StudentRegisrtationController::class, 'update'])->name('student.registration.update');
        Route::post('/registration/Promotion/{student_id}', [StudentRegisrtationController::class, 'promotion'])->name('student.registration.promotion');
        Route::get('/registration/details/{student_id}', [StudentRegisrtationController::class, 'details'])->name('student.registration.details');
        Route::get('/registration/Search', [StudentRegisrtationController::class, 'show'])->name('student.registration.search');

        //student Roll Generate Routes
        Route::get('/roll/view', [StudentRollController::class, 'index'])->name('student.roll.view');
        Route::get('/roll/getstudents', [StudentRollController::class, 'show'])->name('student.registration.getstudents');
        Route::post('/roll/Add', [StudentRollController::class, 'store'])->name('student.roll.add');

        //Student registration fee
        Route::get('/registration/fee/view', [StudentRegiststrationFeeController::class, 'index'])->name('student.registration.fee.view');
        Route::get('/registration/fee/classData', [StudentRegiststrationFeeController::class, 'show'])->name('student.registration.fee.classwise.get');
        Route::get('/registration/fee/payslip', [StudentRegiststrationFeeController::class, 'payslip'])->name('student.registration.fee.payslip');

        //Student monthly Fee
        Route::get('/monthly/fee/view', [StudentMonthlyFeeController::class, 'index'])->name('student.monthly.fee.view');
        Route::get('/monthly/fee/classData', [StudentMonthlyFeeController::class, 'show'])->name('student.monthly.fee.classwise.get');
        Route::get('/monthly/fee/payslip', [StudentMonthlyFeeController::class, 'payslip'])->name('student.monthly.fee.payslip');

        //Student Exam Fee
        Route::get('/exam/fee/view', [StudentExamFeeController::class, 'index'])->name('student.exam.fee.view');
        Route::get('/exam/fee/classData', [StudentExamFeeController::class, 'show'])->name('student.exam.fee.classwise.get');
        Route::get('/exam/fee/payslip', [StudentExamFeeController::class, 'payslip'])->name('student.exam.fee.payslip');
    });

    //Employee
    Route::prefix('Employee')->group(function () {
        //Employee Registration
        Route::get('/registration/view', [EmployeeRegisrtationController::class, 'index'])->name('employee.registration.view');
        Route::get('/registration/add', [EmployeeRegisrtationController::class, 'create'])->name('employee.registration.add');
        Route::post('/registration/add', [EmployeeRegisrtationController::class, 'store'])->name('employee.registration.add');
        Route::get('/registration/edit/{id}', [EmployeeRegisrtationController::class, 'edit'])->name('employee.registration.edit');
        Route::post('/registration/edit/{id}', [EmployeeRegisrtationController::class, 'update'])->name('employee.registration.edit');
        Route::get('/registration/show/{id}', [EmployeeRegisrtationController::class, 'show'])->name('employee.registration.details');

        //Employee Attendance
        Route::get('/attendance/view', [EmployeeAttendanceController::class, 'index'])->name('employee.attendance.view');
        Route::get('/attendance/add', [EmployeeAttendanceController::class, 'create'])->name('employee.attendance.add');
        Route::post('/attendance/add', [EmployeeAttendanceController::class, 'store'])->name('employee.attendance.add');
        Route::get('/attendance/edit/{date}', [EmployeeAttendanceController::class, 'edit'])->name('employee.attendance.edit');
        Route::get('/attendance/show/{date}', [EmployeeAttendanceController::class, 'show'])->name('employee.attendance.details');

        //Employee Leave
        Route::get('/leave/view', [EmployeeLeaveController::class, 'index'])->name('employee.leave.view');
        Route::get('/leave/add', [EmployeeLeaveController::class, 'create'])->name('employee.leave.add');
        Route::post('/leave/add', [EmployeeLeaveController::class, 'store'])->name('employee.leave.add');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'edit'])->name('employee.leave.edit');
        Route::post('/leave/edit/{id}', [EmployeeLeaveController::class, 'update'])->name('employee.leave.edit');
        Route::get('/leave/show/{id}', [EmployeeLeaveController::class, 'destroy'])->name('employee.leave.delete');

        //Employee Salary
        Route::get('/salary/view', [EmployeeSalaryController::class, 'index'])->name('employee.salary.view');
        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');
        Route::post('/salary/add/{id}', [EmployeeSalaryController::class, 'store'])->name('employee.salary.add');
        Route::get('/salary/details/{id}', [EmployeeSalaryController::class, 'SalaryDetails'])->name('employee.salary.details');

        //Employee Monthly Salary
        Route::get('/monthly-salary/view', [MonthlySalaryController::class, 'index'])->name('employee.monthly.salary.view');
        Route::get('/monthly-salary/get', [MonthlySalaryController::class, 'MonthlySalaryGet'])->name('employee.monthly.salary.get');
        Route::get('/monthly-salary/payslip/{employee_id}', [MonthlySalaryController::class, 'MonthlySalaryPayslip'])->name('employee.monthly.salary.payslip');
    });

    //Account
    Route::prefix('account')->group(function () {
        //Account Employee Salary
        Route::get('/salary/view', [AccountSalaryController::class, 'AccountSalaryView'])->name('account.salary.view');
        Route::get('/salary/add', [AccountSalaryController::class, 'AccountSalaryAdd'])->name('account.salary.add');
        Route::get('/salary/get', [AccountSalaryController::class, 'AccountSalaryGetEmployee'])->name('account.salary.getemployee');
        Route::post('/salary/add', [AccountSalaryController::class, 'AccountSalaryStore'])->name('account.salary.store');

        //Account Other Cost
        Route::get('/other/cost/view', [OtherCostController::class, 'index'])->name('other.cost.index');
        Route::get('/other/cost/add', [OtherCostController::class, 'create'])->name('other.cost.create');
        Route::post('/other/cost/add', [OtherCostController::class, 'store'])->name('other.cost.store');
        Route::get('/other/cost/edit/{id}', [OtherCostController::class, 'edit'])->name('other.cost.edit');
        Route::put('/other/cost/edit/{id}', [OtherCostController::class, 'update'])->name('other.cost.update');

        //Account Student Fee
        Route::get('/student/fee/view', [StudentFeeController::class, 'index'])->name('student.fee.index');
        Route::get('/student/fee/get', [StudentFeeController::class, 'StudentFeeGetStudent'])->name('student.fee.getstudent');
        Route::get('/student/fee/add', [StudentFeeController::class, 'create'])->name('student.fee.create');
        Route::post('/student/fee/add', [StudentFeeController::class, 'store'])->name('student.fee.store');
    });

    //Marks
    Route::prefix('marks')->group(function () {
        //Marks Grade
        Route::get('/grade/view', [GradeController::class, 'index'])->name('marks.grade.view');
        Route::get('/grade/add', [GradeController::class, 'create'])->name('marks.grade.add');
        Route::post('/grade/add', [GradeController::class, 'store'])->name('marks.grade.store');
        Route::get('/grade/edit/{id}', [GradeController::class, 'edit'])->name('marks.grade.edit');
        Route::post('/grade/edit/{id}', [GradeController::class, 'update'])->name('marks.grade.update');

        //Marks Marks
        Route::get('/marks/view', [DefaultController::class, 'GetStudents'])->name('student.edit.getstudents');
        Route::get('/marks/getsubject', [DefaultController::class, 'getsubject'])->name('student.edit.getsubject');
        Route::get('/marks/add', [MarksController::class, 'create'])->name('marks.marks.add');
        Route::post('/marks/add', [MarksController::class, 'store'])->name('marks.marks.store');
        Route::get('/marks/edit', [MarksController::class, 'edit'])->name('marks.marks.edit');
        Route::post('/marks/edit', [MarksController::class, 'update'])->name('marks.marks.update');
    });

     //Report
     Route::prefix('report')->group(function () {
        //attendance
        Route::get('/attendance/view', [AttenReportController::class, 'index'])->name('report.attendance.view');
        Route::get('/attendance/pdf', [AttenReportController::class, 'AttenReportGet'])->name('report.attendance.get');
        //MarkSheet
        Route::get('/marksheet/view', [MarkSheetController::class, 'index'])->name('report.marksheet.view');
        Route::get('/marksheet/pdf', [MarkSheetController::class, 'MarkSheetGet'])->name('report.marksheet.get');
        //profit
        Route::get('/profit/view', [ProfiteController::class, 'index'])->name('report.profit.view');
        Route::get('/profit/pdf', [ProfiteController::class, 'MonthlyProfitPdf'])->name('report.profit.pdf');
        Route::get('/profit/get', [ProfiteController::class, 'MonthlyProfitDatewais'])->name('report.profit.datewais.get');
        //Student Result
        Route::get('/result/view', [ResultReportController::class, 'index'])->name('report.result.view');
        Route::get('/result/pdf', [ResultReportController::class, 'ResultGet'])->name('report.student.result.get');
        //Student idcards
        Route::get('/idcards/view', [ResultReportController::class, 'IdcardView'])->name('report.idcards.view');
        Route::get('/idcards/pdf', [ResultReportController::class, 'IdcardGet'])->name('report.student.idcard.get');

    });
}); //login Check

Route::get('send-email', [SendEmailController::class, 'index']);
