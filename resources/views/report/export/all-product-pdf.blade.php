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
                    <th style="width:1px">No</th>
                    <th>Nama Produk</th>
                    <th style="width:150px">Jumlah Penjualan</th>
                    <th style="width:180px">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allProduct_data as $allProduct)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$allProduct['product_name']}}</td>
                        <td style="text-align: center">{{$allProduct['transaction_detail_amount']}} Pcs</td>
                        <td style="text-align: center">Rp. {{$allProduct['transaction_detail_total']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>