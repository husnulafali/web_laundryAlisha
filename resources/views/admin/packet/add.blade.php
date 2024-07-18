@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Tambah Paket</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('packet.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="cd_customer">Kode Paket</label>
                    <input type="text" id="cd_packets" class="form-control" name="cd_packets" value="{{ $newKodePacket }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="customer_name">Nama Paket</label>
                    <input class="form-control @error('packet_name') is-invalid @enderror" id="packet_name" type="text" placeholder="" name="packet_name">
                    @error('packet_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="address">Deskripsi Paket</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3" name="description"></textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="processing_time">Waktu Pengerjaan</label>
                    <input class="form-control @error('packet_name') is-invalid @enderror" id="processing_time" type="text" placeholder="Contoh : 2 Jam 30 Menit" name="processing_time">
                    @error('packet_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                   

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <label for="weight" class="input-group-text">Harga</label>
                    </div>
                          <input class="form-control @error('price') is-invalid @enderror"  type="number" name="price" aria-label="" placeholder="12000">
                          @error('price')
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
