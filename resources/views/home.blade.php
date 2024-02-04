@extends('layouts.app')

<?php
$page = 'Home';
?>

@section('content')
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->role_id === 1)
                        <h2>Selamat Datang Jara!</h2>
                        <p>Periksa Keadaan sistem Bank anda.</p>
                        <!-- Display top-up and cash withdrawal requests -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Nominal</th>
                                    <th>Verifikasi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach ($pengajuans as $key => $pengajuan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $pengajuan->user->name }}</td>
                                            <td>{{ $pengajuan->jumlah }}</td>
                                            <td>
                                            @if(Str::startsWith($pengajuan->invoice_id, 'SAL_'))
                                                    <a href="{{ route('topup.setuju', ['transaksi_id' => $pengajuan->id]) }}"
                                                        class="btn btn-primary">
                                                        Accept
                                                    </a>
                                                    <a href="{{ route('topup.tolak', ['transaksi_id' => $pengajuan->id]) }}"
                                                        class="btn btn-danger">
                                                        Decline
                                                    </a>
                                                    @elseif (Str::startsWith($pengajuan->invoice_id, 'TTN_'))
                                                    <a href="{{ route('tariktunai.setuju', ['transaksi_id' => $pengajuan->id]) }}"
                                                        class="btn btn-primary">
                                                        Accept
                                                    </a>
                                                    <a href="{{ route('tariktunai.tolak', ['transaksi_id' => $pengajuan->id]) }}"
                                                        class="btn btn-danger">
                                                        Decline
                                                    </a>
                                                    @else
                                                    Unknown
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                                </div>
                            
                            </div>  
                        @endif
                        @if (Auth::user()->role_id === 3)
                        <div class="container px-4 px-lg-5 my-5">
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('assets/images/snack2.png')}}" alt="..." /></div>
                                    <div class="col-md-6">
                                        <h1 class="display-5 fw-bolder">Aneka snack</h1>
                                        <div class="fs-5 mb-3">
                                    </div>
                                <p class="lead">Di sini kami menyediakan beraneka ragam snack,dengan harga pelajar.</p>
                                <a class="btn btn-outline-dark mt-auto" href="{{ route('transaksi') }}">Jajan</a>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="container px-4 px-lg-5 my-5 mt-auto">
                        </div>
                        @endif
                        
                        @if (Auth::user()->role_id === 2)
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card" style="border-radius:15px">
                                    <div class="card-header" style="color: white;background-color: #5D73D5;font-weight:bold;font-size:20px;border-radius:10px">{{ __('Dashboard') }}
                                </div>
                                <div class="container">    
                                    <table class="table table-bordered border-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        {{-- <th>Nominal</th> --}}
                                        <th>Invoice ID</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jajan_by_invoices as $key => $jajan_by_invoice)
                                        @if ($jajan_by_invoice->status == 2 || $jajan_by_invoice->status == 3)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $jajan_by_invoice->user->name }}</td>
                                                <td>{{ $jajan_by_invoice->invoice_id }}</td>
                                                {{-- <td>{{ $jajan_by_invoice->jumlah }}</td> --}}
                                                <td>{{ $jajan_by_invoice->status == 2 ? 'Pending' : 'Completed' }}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detail-{{ $jajan_by_invoice->invoice_id }}">
                                                        Detail
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                        id="detail-{{ $jajan_by_invoice->invoice_id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Order #{{ $jajan_by_invoice->invoice_id }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered border-dark table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No.</th>
                                                                                <th>Menu</th>
                                                                                <th>Qty</th>
                                                                                <th>Price</th>
                                                                                <th>Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $counter = 1;
                                                                            $total_harga = 0;
                                                                            ?>
                                                                            @foreach ($pengajuan_jajans as $pengajuan_jajan)
                                                                                @if ($pengajuan_jajan->invoice_id == $jajan_by_invoice->invoice_id)
                                                                                    <?php $total_harga += $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price; ?>
                                                                                    <tr>
                                                                                        <td>{{ $counter++ }}</td>
                                                                                        <td>{{ $pengajuan_jajan->barang->name }}
                                                                                        </td>
                                                                                        <td>{{ $pengajuan_jajan->jumlah }}
                                                                                        </td>
                                                                                        <td>{{ $pengajuan_jajan->barang->price }}
                                                                                        </td>
                                                                                        <td>{{ $pengajuan_jajan->jumlah * $pengajuan_jajan->barang->price }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    Total = {{ $total_harga }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($jajan_by_invoice->status == 3)
                                                        <a href="{{ route('jajan.setuju', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}"
                                                            class="btn btn-primary">
                                                            Accept
                                                        </a>
                                                        <a href="{{ route('jajan.tolak', ['invoice_id' => $jajan_by_invoice->invoice_id]) }}"
                                                            class="btn btn-danger">
                                                            Decline
                                                        </a>
                                                    @else
                                                        Menunggu Pembayaran
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
