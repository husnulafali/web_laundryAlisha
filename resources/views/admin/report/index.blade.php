@extends('layouts.master')

@section('layouts')
<div class="col-12">
    <div class="card mb-4">
        <div class="card-header">
            <strong>Laporan Order</strong>
            <span class="small ms-1"></span>
        </div>
        <div class="card-body">
            <div class="example">
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                        <form method="GET" action="{{route('report.show')}}" class="mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Awal</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror">
                                        @error('start_date')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror">
                                        @error('end_date')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="submit">&nbsp;</label>
                                        <button type="submit" class="btn btn-success form-control" style="font-size: 16px; padding: 4px;">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
