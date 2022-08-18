@php
$header = 'student';
$page = 'student_registration';
@endphp
@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="page-title">Manage Student Registration</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item" aria-current="page">Student Management</li>
                                    <li class="breadcrumb-item active" aria-current="page">Registration</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong>Search</strong></h4>
                            </div>

                            <div class="box-body">
                                <form action="{{route('student.registration.search')}}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year</h5>
                                                <div class="controls">
                                                    <select name="year_id" id="year_id"  class="form-control">
                                                        <option value="">Select Year</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}"  {{ @$year_id ==  $year->id ? 'selected' : '' }}>
                                                                {{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class</h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id"  class="form-control">
                                                        <option value="">Select Class</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}" {{ @$class_id ==  $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px;">
                                            <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student Registration List</h3>
                                <a href="{{ route('student.registration.add') }}" style="float: right"
                                    class="btn btn-rounded btn-success mb-5">Add User</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Name</th>
                                                <th>ID No.</th>
                                                <th>Roll</th>
                                                <th>Year</th>
                                                <th>Class</th>
                                                <th>Image</th>
                                                @if (Auth::user()->role=="Admin")
                                                    <th>Code</th>
                                                @endif
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $key => $data)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $data['student']['name'] }}</td>
                                                    <td>{{ $data['student']['id_number'] }}</td>
                                                    <td>{{$data->roll}}</td>
                                                    <td>{{ $data['student_year']['name'] }}</td>
                                                    <td>{{ $data['student_class']['name'] }}</td>
                                                    <td><img class="rounded-circle" src="{{(!empty($data['student']['image']))? url('upload/student_image/'.$data['student']['image']):url('backend/images/user3-128x128.jpg')}}" alt="User Avatar" style="width: 60px;height:60px;"></td>
                                                    @if (Auth::user()->role=="Admin")
                                                        <td>{{ $data['student']['code'] }}</td>
                                                    @endif
                                                    <td>
                                                        <a href="{{route('student.registration.edit',$data->student_id)}}" class="btn btn-rounded btn-info">Edit</a>
                                                        <a href="{{route('student.registration.add_promotion',$data->student_id)}}"  class="btn btn-rounded btn-danger">Promotion</a>
                                                        <a href="{{route('student.registration.details',$data->student_id)}}" target="_blank" class="btn btn-rounded btn-success">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
