@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Tambah Promo</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="{{route('promo.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="customer_name">Judul Promo</label>
                    <input class="form-control @error('promo_name') is-invalid @enderror" id="promo_name" type="text" placeholder="" name="promo_name">
                    @error('promo_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                <label class="form-label" for="image_promo">Gambar Promo</label>
                 <div class="custom-file">
                <input type="file" class="custom-file-input @error('image_promo') is-invalid @enderror" id="image_promo" name="image_promo" accept=".jpg, .jpeg, .png, .gif">
                <label class="custom-file-label" for="image_promo">Pilih file</label> <!-- Berikan teks default -->
                 @error('image_promo')
                 <div class="invalid-feedback">
                {{$message}}
                 </div>
                 @enderror
                </div>
                 </div>


                <button type="submit" class="btn btn-success" style="float: right;">Simpan</button>
     </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image_promo').addEventListener('change', function() {
        var selectedFile = this.files[0];
        var fileName = selectedFile ? selectedFile.name : 'Choose file';
        var nextSibling = this.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>

@endsection
