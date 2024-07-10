@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Edit Data Pengguna</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
        <form method="post" action="{{route('user.update', $editData->id)}}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" placeholder="" name="username" value="{{$editData->username}}">
                    @error('username')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" placeholder="" name="email" value="{{$editData->email}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="text" placeholder="" name="password" >
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

              <div class="input-group mb-3">
              <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
               <option disabled {{ old('role', $editData->role) == null ? 'selected' : '' }}>Pilih Role</option>
               <option value="owner" {{ old('role', $editData->role) == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="pegawai" {{ old('role', $editData->role) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
               </select>
                @error('role')
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
