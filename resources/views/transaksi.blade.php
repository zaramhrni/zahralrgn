@extends('layouts.app')

<?php
$page = 'Jajan';
?>

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="background-color: #07144b">
                <h5 class="text-white w-75">Saldo: {{ $saldo->saldo }}</h5>
            </div>
        </div>
    </div>
</div>


        <div class="row">
            <div class="col">
                <div class="card">
                <div class="card-header text-center" style="background-color: #light; font-weight: bold; color: black">Menu</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($barangs as $barang)
                                <div class="col-md-4 mt-4">
                                    <div class="card" style="border-color: black">
                                        <img src="{{ asset('assets/images/' . $barang->image) }}" alt="not found" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $barang->name }}</h5>
                                            <p class="card-text">{{ $barang->desc }}</p>
                                            <p class="card-text">Price: {{ $barang->price }}</p>
                                            <form class="m-2" method="POST" action="{{ route('addToCart', ['id' => $barang->id]) }}">
                                                @csrf
                                                <input type="number" name="jumlah" class="form-control" value="1">
                                                <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                                <button class="btn btn-primary mt-2" type="submit">Tambah Ke Keranjang</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header" style="background-color: #fd7e14; font-weight: bold; color: white">Keranjang {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $key => $cart)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $cart->barang->name }}</td>
                                <td>{{ $cart->barang->price }}</td>
                                <td>{{ $cart->jumlah }}</td>
                                <td>{{ $cart->barang->price * $cart->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">Total : {{ $total_cart }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('checkout') }}" class="btn btn-danger">Checkout</a>
            </div>
        </div>

        <br/>

        <div class="container">
            <div class="card">
                <div class="card-header" style="background-color: #FF5733; font-weight: bold; color: white">Checkout {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkouts as $key => $checkout)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $checkout->barang->name }}</td>
                                    <td>{{ $checkout->barang->price }}</td>
                                    <td>{{ $checkout->jumlah }}</td>
                                    <td>{{ $checkout->barang->price * $checkout->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Total : {{ $total_checkout }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('bayar') }}" class="btn btn-success">Beli</a>
                </div>
            </div>
        </div>
    </div>
@endsection
