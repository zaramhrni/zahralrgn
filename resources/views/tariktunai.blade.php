@extends('layouts.app')

<?php
$page ='Tarik Tunai';
?>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background-color: #D3D3D3; border-radius: 10px; color: #333;">
                        <h2 style="margin: 0;">Tarik Tunai</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="saldo-container" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                            <h4 style="margin: 0; color: #333;">SALDO: <b>{{ $saldo->saldo }}</b></h4>
                        </div>

                        <form method="POST" action="{{ route('transaksi.tariktunai') }}">
                            @csrf
                            <div class="form-group mt-4">
                                <label for="amount">Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                    </div>
                                    <input type="number" name="jumlah" class="form-control" placeholder="Nominal Input" aria-label="Amount" aria-describedby="basic-addon1">
                                </div>
                                <input type="hidden" name="type" value="1">
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Tarik Tunai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
