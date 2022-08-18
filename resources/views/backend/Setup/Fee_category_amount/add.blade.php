@php
$header = 'setup';
$page = 'fee_category_amount';
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
                        <h3 class="page-title">Manage Fee Category Amount</h3>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item" aria-current="page">Fee Category Amount</li>
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
                                <h3 class="box-title">Fee Amount Add</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-12">
                                        <form novalidate action="{{ route('fee.amount.add') }} " method="POST"
                                            autocomplete="off">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="form-group">
                                                        <h5>Fee Category <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="fee_category_id" required class="form-control">
                                                                <option value="">Select Fee Category</option>
                                                                @foreach ($fee_categorys as $fee_category)
                                                                    <option value="{{ $fee_category->id }}">
                                                                        {{ $fee_category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add_item">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <h5>Student Class<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="class_id[]" required class="form-control">
                                                                    <option value="">Select Class</option>
                                                                    @foreach ($classes as $class)
                                                                        <option value="{{ $class->id }}">
                                                                            {{ $class->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <h5>Amount<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="amount[]" class="form-control"
                                                                    required
                                                                    data-validation-required-message="This field is required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 25px;">
                                                        <span class="btn btn-success addeventmore"><i
                                                                class="fa fa-plus-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
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
                        <div class="col-md-5">
                            <div class="form-group">
                                <h5>Student Class<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="class_id[]" required class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <h5>Amount<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="amount[]" class="form-control" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top: 25px;">
                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
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
