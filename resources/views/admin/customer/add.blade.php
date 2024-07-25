@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Tambah Pelanggan</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                <label for="cd_customers">Kode Pelanggan </label>
                    <input type="text" id="cd_customers" class="form-control" name="cd_customers" value="{{ $newKodeCustomer }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="customer_name">Nama Pelanggan</label>
                    <input class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" type="text" placeholder="" name="customer_name">
                    @error('customer_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="address">Alamat Pelanggan</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="3" name="address"></textarea>
                    @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <label for="weight" class="input-group-text">No Telp</label>
                    </div>
                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" id="phone_number" name="phone_number" aria-label="">
                    @error('phone_number')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success" style="float: right;">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
