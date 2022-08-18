@php
$header = 'setup';
$page = 'assign_subject';
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
                        <h3 class="page-title">Manage Assign Subject</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item" aria-current="page">Assign Subject</li>
                                    {{-- <li class="breadcrumb-item active" aria-current="page">Data Tables</li> --}}
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
                                <h3 class="box-title">Assign Subject</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form novalidate action="{{route('assign.subject.update',$data[0]->class_id)}}" method="POST"
                                            autocomplete="off">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h5>Class <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id" required class="form-control">
                                                                <option value="">Select Class</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        {{ $data[0]->class_id == $class->id ? 'selected' : '' }}>
                                                                        {{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add_item">
                                                @foreach ($data as $edit)
                                                    <div class="delete_whole_extra_item_add"
                                                        id="delete_whole_extra_item_add">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h5>Subject<span class="text-danger">*</span>
                                                                    </h5>
                                                                    <div class="controls">
                                                                        <select name="subject_id[]" required
                                                                            class="form-control">
                                                                            <option value="">Select Subject</option>
                                                                            @foreach ($subjects as $subject)
                                                                                <option value="{{ $subject->id }}"
                                                                                    {{ $edit->subject_id == $subject->id ? 'selected' : '' }}>
                                                                                    {{ $subject->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <h5>Full Marks<span class="text-danger">*</span></h5>
                                                                    <div class="controls">
                                                                        <input type="text" name="full_mark[]"
                                                                            value="{{ $edit->full_mark }}"
                                                                            class="form-control" required
                                                                            data-validation-required-message="This field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <h5>Pass Marks<span class="text-danger">*</span></h5>
                                                                    <div class="controls">
                                                                        <input type="text" name="pass_mark[]"
                                                                            value="{{ $edit->pass_mark }}"
                                                                            class="form-control" required
                                                                            data-validation-required-message="This field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <h5>Subjective Marks<span class="text-danger">*</span></h5>
                                                                    <div class="controls">
                                                                        <input type="text" name="subjective_mark[]"
                                                                            value="{{ $edit->subjective_mark }}"
                                                                            class="form-control" required
                                                                            data-validation-required-message="This field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2" style="padding-top: 25px;">
                                                                <span class="btn btn-success addeventmore"><i
                                                                        class="fa fa-plus-circle"></i></span>
                                                                <span class="btn btn-danger removeeventmore"><i
                                                                        class="fa fa-minus-circle"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
    {{-- ------------------------------------------------------------------------------------------ --}}
    <div style="visibility:hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                {{-- <div class="form-row"> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Subject<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="subject_id[]" required class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>Full Marks<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="full_mark[]" class="form-control"
                                        required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>Pass Marks<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="pass_mark[]" class="form-control"
                                        required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <h5>Subjective Marks<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="subjective_mark[]"
                                        class="form-control" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <span class="btn btn-success addeventmore"><i
                                    class="fa fa-plus-circle"></i></span>
                                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            })
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter--;
            });
        });
    </script>
@endsection
