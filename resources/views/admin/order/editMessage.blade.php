@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Edit Pesan</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
        <form method="post" action="{{ route('order.updateMessage.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="custom_message">Pesan Custom</label>
                <textarea name="custom_message" id="custom_message" class="form-control" rows="4" placeholder="contoh custom penulisan : selamat pagi *{customerName}* laundry anda dengan kode *{orderCode}*  telah *{status}* ">{{ old('custom_message', session('custom_message', cache("user_" . Auth::id() . "_custom_message"))) }}</textarea>
                <small class="form-text text-muted">Kosongkan jika ingin menggunakan pesan default</small>
                </div>
             
                <button type="submit" class="btn btn-success" style="float: right;">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

