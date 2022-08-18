@php
$header = 'student';
$page = 'student_registration';
@endphp
@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student Registration Add</h3>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col">
                                        <form novalidate action="{{ route('student.registration.promotion',$data->student_id) }} " method="POST" enctype="multipart/form-data"
                                            autocomplete="off">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Student Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control" required value="{{$data['student']['name']}}"
                                                                data-validation-required-message="This field is required">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="father_name" class="form-control" value="{{$data['student']['father_name']}}"
                                                                required
                                                                data-validation-required-message="This field is required">
                                                            @error('father_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mother_name" class="form-control" value="{{$data['student']['mother_name']}}"
                                                                required
                                                                data-validation-required-message="This field is required">
                                                            @error('mother_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Mobile Number<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mobile" class="form-control" required value="{{$data['student']['mobile']}}"
                                                                data-validation-required-message="This field is required">
                                                            @error('mobile')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Address<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" class="form-control" value="{{$data['student']['address']}}"
                                                                required
                                                                data-validation-required-message="This field is required">
                                                            @error('address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Gender <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="gender" id="gender" required
                                                                class="form-control">
                                                                <option value="">Select Gender</option>
                                                                <option value="Male" {{ @$data['student']['gender'] ==  "Male" ? 'selected' : '' }}>Male</option>
                                                                <option value="Female" {{ @$data['student']['gender'] ==  "Female" ? 'selected' : '' }}>Female</option>
                                                                <option value="Other" {{@$data['student']['gender'] ==  "Other" ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                            @error('gender')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Religion <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="religion" id="religion" required
                                                                class="form-control">
                                                                <option value="">Select Religion</option>
                                                                <option value="Hindu" {{@$data['student']['religion'] ==  "Hindu" ? 'selected' : '' }}>Hindu</option>
                                                                <option value="Islam" {{@$data['student']['religion'] ==  "Islam" ? 'selected' : '' }}>Islam</option>
                                                                <option value="Christan" {{@$data['student']['religion'] ==  "Christan" ? 'selected' : '' }}>Christan</option>
                                                            </select>
                                                            @error('religion')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Date of Birth<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="date" name="dob" class="form-control" required  value="{{$data['student']['dob']}}"
                                                                data-validation-required-message="This field is required">
                                                            @error('dob')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Discount</h5>
                                                        <div class="controls">
                                                            <input type="text" name="discount" class="form-control" value="{{$data['discount']['discount']}}"
                                                                data-validation-required-message="This field is required">
                                                            @error('discount')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Year<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="year_id" id="year_id" required
                                                                class="form-control">
                                                                <option value="">Select Year</option>
                                                                @foreach ($years as $year)
                                                                    <option value="{{ $year->id }}" {{@$data->year_id ==  $year->id ? 'selected' : '' }}>
                                                                        {{ $year->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('year_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Class<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id" id="class_id" required
                                                                class="form-control">
                                                                <option value="">Select Class</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}" {{@$data->class_id ==  $class->id ? 'selected' : '' }}>
                                                                        {{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('class_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Group<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="group_id" id="group_id" required
                                                                class="form-control">
                                                                <option value="">Select Group</option>
                                                                @foreach ($groups as $group)
                                                                    <option value="{{ $group->id }}" {{@$data->group_id ==  $group->id ? 'selected' : '' }}>
                                                                        {{ $group->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('group_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Shift<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="shift_id" id="group_id" required
                                                                class="form-control">
                                                                <option value="">Select Shift</option>
                                                                @foreach ($shifts as $shift)
                                                                    <option value="{{ $shift->id }}" {{@$data->shift_id ==  $shift->id ? 'selected' : '' }}>
                                                                        {{ $shift->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('shift_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Image</h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" id="image"
                                                                class="form-control" aria-invalid="false">
                                                            @error('image')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Image <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <img class="rounded-circle" id="showImage"
                                                                src="{{(!empty($data['student']['image']))? url('upload/student_image/'.$data['student']['image']):url('backend/images/user3-128x128.jpg')}}"
                                                                alt="User Avatar">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
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
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>
@endsection
