<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>

<body>

    <table style="width: 100%">
        <tr>
            <td style="width: 70%">
                <h2>Easy Learning</h2>
            </td>
            <td>
                <h2>Easy School ERP</h2>
                <p>School Address</p>
                <p>Phone : 3456453467</p>
                <p>Email : info@easylearning.com</p>
                <p><b>Student Monthly Fee</b></p>
            </td>
        </tr>
    </table>
@php
    $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$data->class_id)->first();
    $originalfee = $registrationfee->amount;
    $discount = $data['discount']['discount'];
    $discounttablefee = $discount/100*$originalfee;
    $finalfee = (float)$originalfee-(float)$discounttablefee;
@endphp
    <table id="customers">
        <thead>
            <tr>
                <th width="10%">SL</th>
                <th width="45%">Student Details</th>
                <th width="45%">Student Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><b>Student ID No. : </b></td>
                <td>{{ $data['student']['id_number'] }}</td>
            </tr>
           
            <tr>
                <td>2</td>
                <td><b>Student Roll : </b></td>
                <td>{{ $data->roll }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td><b>Student Name : </b></td>
                <td>{{ $data['student']['name'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td><b>Father's Name : </b></td>
                <td>{{ $data['student']['father_name'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td><b>Session : </b></td>
                <td>{{ $data['student_year']['name'] }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td><b>Class : </b></td>
                <td>{{ $data['student_class']['name'] }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td><b>Monthly Fee : </b></td>
                <td>{{ $originalfee }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td><b>Discount Fee : </b></td>
                <td>{{ $discounttablefee }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td><b>Fee For this Student of {{$month}}: </b></td>
                <td>{{ $finalfee }}</td>
            </tr>
           
        </tbody>
    </table>
    <i style="font-size: 10px;float:right;">Print Date : {{ date('d/m/Y') }}</i>
    <hr style="border: dashed 2px;width:95%;color:#000000;margin-bottom:50px;">
   
    <table id="customers">
        <thead>
            <tr>
                <th width="10%">SL</th>
                <th width="45%">Student Details</th>
                <th width="45%">Student Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><b>Student ID No. : </b></td>
                <td>{{ $data['student']['id_number'] }}</td>
            </tr>
           
            <tr>
                <td>2</td>
                <td><b>Student Roll : </b></td>
                <td>{{ $data->roll }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td><b>Student Name : </b></td>
                <td>{{ $data['student']['name'] }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td><b>Father's Name : </b></td>
                <td>{{ $data['student']['father_name'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td><b>Session : </b></td>
                <td>{{ $data['student_year']['name'] }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td><b>Class : </b></td>
                <td>{{ $data['student_class']['name'] }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td><b>Monthly Fee : </b></td>
                <td>{{ $originalfee }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td><b>Discount Fee : </b></td>
                <td>{{ $discounttablefee }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td><b>Fee For this Student  of {{$month}}: </b></td>
                <td>{{ $finalfee }}</td>
            </tr>
           
        </tbody>
    </table>
    <i style="font-size: 10px;float:right;">Print Date : {{ date('d/m/Y') }}</i>
</body>
</html>
<script>
    window.print();
</script>
