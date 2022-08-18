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
            </td>
        </tr>
    </table>

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
                <td><b>Student Name : </b></td>
                <td>{{ $data['student']['name'] }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td><b>Student ID No. : </b></td>
                <td>{{ $data['student']['id_number'] }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td><b>Student Roll : </b></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td><b>Father's Name : </b></td>
                <td>{{ $data['student']['father_name'] }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td><b>Mother's Name : </b></td>
                <td>{{ $data['student']['mother_name'] }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td><b>Mobile Number : </b></td>
                <td>{{ $data['student']['mobile'] }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td><b>Address : </b></td>
                <td>{{ $data['student']['address'] }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td><b>Gender : </b></td>
                <td>{{ $data['student']['gender'] }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td><b>Religion : </b></td>
                <td>{{ $data['student']['religion'] }}</td>
            </tr>
            <tr>
                <td>10</td>
                <td><b>Date of Birth : </b></td>
                <td>{{ date('d/m/Y', strtotime($data['student']['dob'])) }}</td>
            </tr>
            <tr>
                <td>11</td>
                <td><b>Discount : </b></td>
                <td>{{ $data['discount']['discount'] }} %</td>
            </tr>
            <tr>
                <td>12</td>
                <td><b>Class : </b></td>
                <td>{{ $data['student_class']['name'] }}</td>
            </tr>
            <tr>
                <td>13</td>
                <td><b>Year : </b></td>
                <td>{{ $data['student_year']['name'] }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td><b>Group : </b></td>
                <td>{{ @$data['student_group']['name'] }}</td>
            </tr>
            <tr>
                <td>15</td>
                <td><b>Shift : </b></td>
                <td>{{ @$data['student_shift']['name'] }}</td>
            </tr>
            <tr>
                <td>16</td>
                <td><b>Photo : </b></td>
                <td><img class="rounded-circle" id="showImage"
                        src="{{ !empty($data['student']['image'])? url('upload/student_image/' . $data['student']['image']): url('backend/images/user3-128x128.jpg') }}"
                        alt="User Avatar" style="width: 150px;height:150px;"></td>
            </tr>
        </tbody>
    </table>
    <i style="font-size: 10px;float:right;">Print Date : {{ date('d/m/Y') }}</i>
</body>
</html>


<script>
    window.print();
</script>
