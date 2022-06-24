<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-family: sans-serif;
        }
        table,th,td {
            border:0.5px solid black;
            border-spacing: 0;
            width:100%;
        }
        th,td {
            padding:8px;
        }
        th {
            background: #17a2b8;
            color:white;
        }
        .header-text{
            text-align: center
        }
    </style>
</head>
<body>
    <div>
        <div class="header-text">
            <h2>{{$config_data->carwash_name}}</h2>
            <p>{{$config_data->carwash_address}}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:10px">No</th>
                    <th>Nama Karyawan</th>
                    <th style="width:150px">NIP</th>
                    <th style="width:180px">Komisi (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commission_data as $commission)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$commission['employee_fullname']}}</td>
                        <td style="text-align: center">{{$commission['id_employee']}}</td>
                        <td style="text-align: center">Rp. {{$commission['commission']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>