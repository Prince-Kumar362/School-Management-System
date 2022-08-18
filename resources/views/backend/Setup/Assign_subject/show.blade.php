@php
    $header='setup';
    $page='assign_subject';
@endphp
@extends('admin.admin_master')
@section('admin')
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
                                <h3 class="box-title">Assign Subject Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Class : </strong>{{$datas[0]['student_class']['name']}}</h4>
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Subject</th>
                                                <th>Full Marks</th>
                                                <th>Pass Marks</th>
                                                <th>Subjective Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $key => $data)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $data['SchoolSubject']['name'] }}</td>
                                                    <td>{{$data->full_mark}}</td>
                                                    <td>{{$data->pass_mark}}</td>
                                                    <td>{{$data->subjective_mark}}</td>
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
