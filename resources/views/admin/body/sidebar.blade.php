@php
    $prefix=Request::route()->getPrefix();
    $route=Route::current()->getName();
@endphp
{{-- @dd($prefix) --}}
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>{{Auth::user()->name}}</b><br>{{Auth::user()->usertype}}</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{($route=='dashboard')?'active':'' }}">
                <a href="{{route('dashboard')}}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{(@$header=='home')?'active':'' }}">
                <a href="#">
                    <i data-feather="home"></i>
                    <span>Home</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='about')?'active':'' }}"><a href="{{route('home.about')}}"><i class="ti-more"></i>About US</a></li>
                    <li class="{{(@$page=='slider')?'active':'' }}"><a href="{{route('home.slider')}}"><i class="ti-more"></i>Slider</a></li>
                    <li class="{{(@$page=='contact')?'active':'' }}"><a href="{{route('home.contact')}}"><i class="ti-more"></i>Contact US</a></li>
                    <li class="{{(@$page=='multipleImage')?'active':'' }}"><a href="{{route('home.multipleImage')}}"><i class="ti-more"></i>Multiple Image</a></li>
                </ul>
            </li>
            @if (Auth::user()->role=='Admin')
            <li class="treeview {{(@$header=='user')?'active':'' }}">
                <a href="#">
                    <i data-feather="award"></i>
                    <span>Manage User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='user_view')?'active':'' }}"><a href="{{route('user.view')}}"><i class="ti-more"></i>View User</a></li>
                    <li class="{{(@$page=='user_add')?'active':'' }}"><a href="{{route('user.add')}}"><i class="ti-more"></i>Add User</a></li>
                </ul>
            </li>
            @endif
            <li class="treeview {{(@$header=='profile')?'active':'' }}"">
                <a href="#">
                    <i data-feather="mail"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='profile_view')?'active':'' }}"><a href="{{route('user.profile')}}"><i class="ti-more"></i>Your Profile</a></li>
                    <li class="{{(@$page=='change_password')?'active':'' }}"><a href="{{route('password.change')}}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$header=='setup')?'active':'' }}"">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Setup Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='student_class')?'active':'' }}"><a href="{{route('student.class.view')}}"><i class="ti-more"></i>Student Class</a></li>
                    <li class="{{(@$page=='student_year')?'active':'' }}"><a href="{{route('student.year.view')}}"><i class="ti-more"></i>Student Year</a></li>
                    <li class="{{(@$page=='student_group')?'active':'' }}"><a href="{{route('student.group.view')}}"><i class="ti-more"></i>Student Group</a></li>
                    <li class="{{(@$page=='student_shift')?'active':'' }}"><a href="{{route('student.shift.view')}}"><i class="ti-more"></i>Student Shift</a></li>
                    <li class="{{(@$page=='fee_category')?'active':'' }}"><a href="{{route('fee.category.view')}}"><i class="ti-more"></i>Fee Category</a></li>
                    <li class="{{(@$page=='fee_category_amount')?'active':'' }}"><a href="{{route('fee.amount.view')}}"><i class="ti-more"></i>Fee Category Amount</a></li>
                    <li class="{{(@$page=='exam_type')?'active':'' }}"><a href="{{route('exam.type.view')}}"><i class="ti-more"></i>Exam Type</a></li>
                    <li class="{{(@$page=='subject')?'active':'' }}"><a href="{{route('school.subject.view')}}"><i class="ti-more"></i>School Subject</a></li>
                    <li class="{{(@$page=='assign_subject')?'active':'' }}"><a href="{{route('assign.subject.view')}}"><i class="ti-more"></i>Assign Subject</a></li>
                    <li class="{{(@$page=='designation')?'active':'' }}"><a href="{{route('designation.view')}}"><i class="ti-more"></i>Designation</a></li>

                </ul>
            </li>
            <li class="treeview {{(@$header=='student')?'active':'' }}"">
                <a href="#">
                    <i data-feather="users"></i>
                    <span>Student Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='student_registration')?'active':'' }}"><a href="{{route('student.registration.view')}}"><i class="ti-more"></i>Student Registration</a></li>
                    <li class="{{(@$page=='student_roll')?'active':'' }}"><a href="{{route('student.roll.view')}}"><i class="ti-more"></i>Student Roll</a></li>
                    <li class="{{(@$page=='student_registration_fee')?'active':'' }}"><a href="{{route('student.registration.fee.view')}}"><i class="ti-more"></i>Registration Fee</a></li>
                    <li class="{{(@$page=='student_monthly_fee')?'active':'' }}"><a href="{{route('student.monthly.fee.view')}}"><i class="ti-more"></i>Monthly Fee</a></li>
                    <li class="{{(@$page=='student_exam_fee')?'active':'' }}"><a href="{{route('student.exam.fee.view')}}"><i class="ti-more"></i>Exam Fee</a></li>
                </ul>
            </li>
            <li class="treeview {{(@$header=='employee')?'active':'' }}"">
                <a href="#">
                    <i data-feather="user"></i>
                    <span>Employee Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='employee_registration')?'active':'' }}"><a href="{{route('employee.registration.view')}}"><i class="ti-more"></i>Employee Registration</a></li>
                    <li class="{{(@$page=='employee_attendance')?'active':'' }}"><a href="{{route('employee.attendance.view')}}"><i class="ti-more"></i>Employee Attendance</a></li>
                    <li class="{{(@$page=='employee_leave')?'active':'' }}"><a href="{{route('employee.leave.view')}}"><i class="ti-more"></i>Employee Leave</a></li>
                    <li class="{{(@$page=='employee_salary')?'active':'' }}"><a href="{{route('employee.salary.view')}}"><i class="ti-more"></i>Employee Salary</a></li>
                    <li class="{{(@$page=='employee_monthly_salary')?'active':'' }}"><a href="{{route('employee.monthly.salary.view')}}"><i class="ti-more"></i>Employee Monthly Salary</a></li>

                </ul>
            </li>
            <li class="treeview {{(@$header=='account')?'active':'' }}"">
                <a href="#">
                    <i data-feather="clipboard"></i>
                    <span>Account Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='account_employee_salary')?'active':'' }}"><a href="{{route('account.salary.view')}}"><i class="ti-more"></i>Account Salary</a></li>
                    <li class="{{(@$page=='account_other_cost')?'active':'' }}"><a href="{{route('other.cost.index')}}"><i class="ti-more"></i>Account Other Cost</a></li>
                    <li class="{{(@$page=='account_student_fee')?'active':'' }}"><a href="{{route('student.fee.index')}}"><i class="ti-more"></i>Account Student Fee</a></li>

                </ul>
            </li>
            <li class="treeview {{(@$header=='marks')?'active':'' }}"">
                <a href="#">
                    <i data-feather="file-plus"></i>
                    <span>Marks Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='marks_grade')?'active':'' }}"><a href="{{route('marks.grade.view')}}"><i class="ti-more"></i>Grade</a></li>
                    <li class="{{(@$page=='marks_marks')?'active':'' }}"><a href="{{route('marks.marks.add')}}"><i class="ti-more"></i>Marks</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">Report</li>

            <li class="treeview {{(@$header=='report')?'active':'' }}"">
                <a href="#">
                    <i data-feather="book"></i>
                    <span>Report Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{(@$page=='report_attendence')?'active':'' }}"><a href="{{route('report.attendance.view')}}"><i class="ti-more"></i>Attendance</a></li>
                    <li class="{{(@$page=='report_marksheet')?'active':'' }}"><a href="{{route('report.marksheet.view')}}"><i class="ti-more"></i>Marksheet</a></li>
                    <li class="{{(@$page=='report_profit')?'active':'' }}"><a href="{{route('report.profit.view')}}"><i class="ti-more"></i>Profit</a></li>
                    <li class="{{(@$page=='report_result')?'active':'' }}"><a href="{{route('report.result.view')}}"><i class="ti-more"></i>Student Result</a></li>
                    <li class="{{(@$page=='report_idcards')?'active':'' }}"><a href="{{route('report.idcards.view')}}"><i class="ti-more"></i>Student IDCards</a></li>
                </ul>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
