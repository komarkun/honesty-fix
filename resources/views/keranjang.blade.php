<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Honesty</title>

    <link href="{{asset('css/card.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{url('warung')}}">
        <span class="align-middle">Honesty</span>
        </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Beranda
                    </li>



                    <li class="sidebar-item {{ (request()->is('warung')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{url('warung')}}">
            <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Menu</span>
            </a>
                    </li>

                    <li class="sidebar-item {{ (request()->is('warung/keranjang')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{url('warung/keranjang')}}">
            <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Keranjang <span id="total"></span></span>
            </a>
                    </li>
                    <li class="sidebar-header">
                        Kategori
                    </li>


                    @foreach ($kategori as $kg)
                    <li class="sidebar-item {{ (request()->is('warung/produk')) ? 'active' : '' }}">
                        <a class="sidebar-link " href="{{url('warung/produk')}}/{{$kg->id_kategori}}">
            <span class="align-middle">{{$kg->nama_kategori}}</span>
            </a>
                    </li>
                    @endforeach









                    </ul>




            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>

        </a>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">

                <a href="{{url('warung/keranjang')}}" class="btn"><i class="fa-solid fa-cart-plus end"></i><span id="total2"></span></a>

            </ul>
        </div>

        </nav>






            <main class="content">
                <!-- Button trigger modal -->

                <div class="container-fluid p-0">

                    <div class="container  h-100 hp mb-5">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                          <div class="col-md-12 col-xl-10">

                            <div class="card ">
                              <div class="card-header p-3">
                                <h5 class="mb-0"><i class="fas fa-cart-shopping me-2"></i>Keranjang</h5>
                              </div>
                              <div class="card-body" data-mdb-perfect-scrollbar="true">
                                <div id="tampil"></div>
                                {{-- @foreach ($transaksidetail as $td)
                                <div class="d-flex justify-content-between">
                                    <h4>{{$td->jumlah}}</h4>
                                    <h4 class="text-success">Rp{{number_format($td->harga_satuan*$td->jumlah)}}</h4>
                                </div>
                                <div class="d-flex justify-content-center pt-2">
                                    <div class="col">
                                        <img src="{{asset('upload/foto_produk')}}/{{$td->produk->foto_produk}}" alt="" style="width: 120px">
                                        <div class="d-flex justify-content-between pt-2 " style="width: 120px">

                                                <button class="" style="background-color: transparent;border-color: transparent;width: 11%"><a  href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                                    class="fas fa-trash-alt text-danger " data-toggle="modal" data-target="#hapus_produkhp{{$td->produk->id_produk}}"></i></a></button>

                                                    @if ($td->jumlah ==1)
                                                    <button class="" style="background-color: transparent;border-color: transparent;width: 11%" ><a onclick="return false" href="{{url('warung/keranjang-kurang')}}/{{$td->produk_id}}" data-mdb-toggle="tooltip" title="Remove"><i
                                                        class="fas fa-minus text-danger"></i></a></button>
                                                    @else
                                                    <button id="{{$td->produk_id}}"   onclick="id_kurang(this.id)" style="background-color: transparent;border-color: transparent;width: 11%" ><a data-mdb-toggle="tooltip" title="Remove"><i
                                                        class="fas fa-minus text-danger"></i></a></button>
                                                    @endif

                                                <button id="{{$td->produk_id}}"   onclick="id_tambah(this.id)" style="background-color: transparent;border-color: transparent;"> <a  data-mdb-toggle="tooltip" title="Done"><i
                                                    class="fas fa-add text-success "></i></a></button>

                                        </div>
                                    </div>
                                    <h6 class="ps-2" style="text-align: right">{{$td->produk->nama_produk}}</h6>
                                </div>
                                <hr>
                                @endforeach --}}
                                @foreach ($transaksidetail as $td)
                                    <div class="modal fade" id="hapus_produkhp{{$td->produk->id_produk}}" tabindex="-1" role="dialog" aria-labelledby="hapus-transaksi" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Menu?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus menu {{$td->produk->nama_produk}} dari keranjang?</p>
                                                <img class="img-fluid img-thumbnail mx-auto d-block" style="height: 200px;" src="{{asset('upload/foto_produk')}}/{{$td->produk->foto_produk}}">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <form action="{{url('warung/keranjang')}}/{{$td->produk_id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">hapus</button>
                                                </form>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach





                                <h5 class="mt-5">Jumlah Pesanan</h5>
                                <div class="d-flex justify-content-between">
                                    <p>Sub Total:</p>
                                    <div id="jumlah"></div>

                                </div>


                              </div>
                              <div class="card-footer text-end p-2">
                                <a href="{{url('warung')}}" class="me-2 btn btn-link">Kembali ke menu</a>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#selesai">Selesai</a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      @if ($transaksidetail->isEmpty())
                      <div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="selesai" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Keranjang Anda Masih Kosong</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>





                            </div>
                            </div>
                        </div>
                        @else
                        <div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="selesai" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin dengan pesanan Anda?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>


                                    <a class="btn btn-primary" href="{{url('warung/receipt')}}">Ya</a>


                                </div>
                                </div>
                            </div>
                      @endif

                    </div>

                    <div class="container  h-100 pc">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                          <div class="col-md-12 col-xl-10">

                            <div class="card">
                              <div class="card-header p-3">
                                <h5 class="mb-0"><i class="fas fa-cart-shopping me-2"></i>Keranjang</h5>
                              </div>
                              <div class="card-body" data-mdb-perfect-scrollbar="true">
                                <div id="tampilpc"></div>
                                {{--  --}}
                                    {{-- @foreach ($transaksidetail as $td)
                                    <div class="modal fade" id="hapus_produkpc{{$td->produk->id_produk}}" tabindex="-1" role="dialog" aria-labelledby="hapus-transaksi" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Menu?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus menu {{$td->produk->nama_produk}} dari keranjang?</p>
                                                <img class="img-fluid img-thumbnail mx-auto d-block" style="height: 200px;" src="{{asset('upload/foto_produk')}}/{{$td->produk->foto_produk}}">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <form action="{{url('warung/keranjang')}}/{{$td->produk_id}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">hapus</button>
                                                </form>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                                                      </tbody>
                                </table> --}}
                                @foreach ($transaksidetail as $td)
    <div class="modal fade" id="hapus_produkpc{{$td->produk->id_produk}}" tabindex="-1" role="dialog" aria-labelledby="hapus-transaksi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Menu?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus menu {{$td->produk->nama_produk}} dari keranjang?</p>
                <img class="img-fluid img-thumbnail mx-auto d-block" style="height: 200px;" src="{{asset('upload/foto_produk')}}/{{$td->produk->foto_produk}}">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <form action="{{url('warung/keranjang')}}/{{$td->produk_id}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">hapus</button>
                </form>

            </div>
            </div>
        </div>
    </div>
    @endforeach
                                <h5 class="mt-5">Jumlah Pesanan</h5>
                                <div class="d-flex justify-content-between">
                                    <p>Sub Total:</p>
                                    <div id="jumlah2"></div>
                                    {{-- <h3 class="text-success">Rp{{number_format($transaksinow->total_harga)}}</h3> --}}
                                </div>
                              </div>
                              <div class="card-footer text-end p-2">
                                <a href="{{url('warung')}}" class="me-2 btn btn-link">Kembali ke menu</a>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#selesai">Selesai</a>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>



                </div>
            </main>


        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

    $(document).ready(function(){
        tampil();
        tampilPc();
        jumlah();
        total();
        console.log("ini jalan");
        });

    function tampil(){
        $.get("{{url('warung/detail')}}",{},function(data,status){
            $("#tampil").html(data)
        });
    }

    function tampilPc(){
        $.get("{{url('warung/detailpc')}}",{},function(data,status){
            $("#tampilpc").html(data)
        });
    }

    function jumlah(){
        $.get("{{url('warung/jumlah')}}",{},function(data,status){
            $("#jumlah").html(data)
            $("#jumlah2").html(data)
        });
    }

    function total(){
        $.get("{{url('warung/total')}}",{},function(data,status){
            $("#total").html(data)
            $("#total2").html(data)
        });
    }

    function id_tambah(clickID) {
        var id = clickID;
        // $.get("keranjang-tambah/".id, function(data){
        //     // Display the returned data in browser
        //     alert("JALAN");
        // });

        $.ajax({
            type:"get",
            url:"{{url('warung/keranjang-tambah')}}/"+id,
            data: "id=" +id,
            success:function(data){
                console.log("keranjang-tambah/"+id);
                tampil();
                tampilPc();
                jumlah();
                total();

            }
        });
    }

    function id_kurang(clickID) {
        var id = clickID;
        // $.get("keranjang-tambah/".id, function(data){
        //     // Display the returned data in browser
        //     alert("JALAN");
        // });

        $.ajax({
            type:"get",
            url:"{{url('warung/keranjang-kurang')}}/"+id,
            data: "id=" +id,
            success:function(data){
                console.log("keranjang-kurang/"+id);
                tampil();
                tampilPc();
                jumlah();
                total();

            }
        });
    }
</script>

@include('sweetalert::alert')


</body>

</html>
