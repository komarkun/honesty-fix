<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
    <title>Receipt</title>
</head>
<body>
    <main class="content" style="width: 500px; margin:auto;padding-top: 40px">
        <!-- Button trigger modal -->

        <div class="container-fluid p-0">

            <strong>

            <div class="row">

                <div class="col-xl-12 d-flex mb-5 d-flex justify-content-center" >
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h1 class="text-center">Detail Pesanan</h1>
                                        <table>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>: {{$date->format("d M Y H:i:s")}}</td>
                                            </tr>
                                            <tr>
                                                <td>OrderID</td>
                                                <td>: {{$transaksinow->id_transaksi}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah</td>
                                                <td>: {{$transaksinow->total_item}}</td>
                                            </tr>
                                        </table>
                                        {{ str_pad("", 41, "=") }}
                                        <table style="width: 100%">
                                            @foreach ($pesanan as $ps)
                                            <tr>
                                                <td style="width: 40%">{{$ps->produk->nama_produk}}</td>
                                                <td style="width: 50%">{{$ps->jumlah}}</td>
                                                <td>Rp{{number_format($ps->harga_satuan * $ps->jumlah)}}</td>
                                            </tr>
                                            @endforeach

                                        </table>
                                        <br>
                                        {{ str_pad("", 41, "=") }}
                                        <div class="d-flex justify-content-between">
                                            <p>Total :</p>
                                            <p>Rp.{{number_format($transaksinow->total_harga)}}</p>
                                        </div>
                                     
                
                                        <div class="d-flex justify-content-center mb-5">
                                            <a href="http://127.0.0.1:8000/checkout">
                                                <button class="btn btn-primary" style="background-color: #FF8A00; border: none; border-radius: 10px;">Checkout</button>
                                            </a>
    
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
           

        </div>
    </main>
</body>
</html>
