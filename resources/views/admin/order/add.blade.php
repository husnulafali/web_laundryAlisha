@extends('layouts.master')
@section('layouts')

<div class="container-fluid">
    <h4 class="h4 mb-3 text-gray-800">Tambah Orders</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="cd_orders" class="input-group-text">Kode Order</label>
                    </div>
                    <input class="form-control @error('cd_orders') is-invalid @enderror" type="text" name="cd_orders" value="{{ $newKodeOrder }}" readonly>
                    @error('cd_orders')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                 <div class="input-group-prepend">
                  <label for="order_date" class="input-group-text">Tanggal Order</label>
                  </div>
                   <input class="form-control @error('order_date') is-invalid @enderror" id="order_date" type="text" name="order_date" placeholder="dd/mm/yyyy"/>
                   <div class="input-group-append">
                   <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    @error('order_date')
                    <div class="invalid-feedback">
                    {{$message}}
                   </div>
                    @enderror
                   </div>

                <div class="input-group mb-3">
                    <select class="form-control @error('cd_customers') is-invalid @enderror" name="cd_customers" id="customer">
                        <option disabled selected>Nama Customer</option>
                        @foreach ($customers as $data)
                            <option value="{{ $data->cd_customers }}">{{ $data->customer_name }} - {{ $data->phone_number }}</option>
                        @endforeach
                    </select>
                    @error('cd_customers')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <select class="form-control @error('cd_packets') is-invalid @enderror" name="cd_packets" id="cd_packets">
                        <option disabled selected>Jenis Paket</option>
                        @foreach ($packets as $data)
                            <option value="{{ $data->cd_packets }}" data-price="{{ $data->price }}">{{ $data->packet_name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="packetPrice">
                    @error('cd_packets')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="weight" class="input-group-text">Berat</label>
                    </div>
                    <input class="form-control @error('weight') is-invalid @enderror" type="number" name="weight" id="weight" step="0.01">
                    @error('weight')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="discount" class="input-group-text">Diskon %</label>
                    </div>
                    <input class="form-control @error('discount') is-invalid @enderror" type="number" name="discount" id="discount" step="0.01">
                    @error('discount')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="total_payment" class="input-group-text">Total Pembayaran</label>
                    </div>
                    <input class="form-control @error('total_payment') is-invalid @enderror" type="text" name="total_payment" id="total_payment" readonly>
                    @error('total_payment')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <select class="form-control @error('payment_status') is-invalid @enderror" name="payment_status">
                        <option disabled selected>Status Pembayaran</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="payment_date" class="input-group-text">Tanggal Pembayaran</label>
                    </div>
                    <input class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" type="text" name="payment_date" placeholder="dd/mm/yyyy" />
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                    @error('payment_date')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" rows="3" name="note" placeholder="Catatan"></textarea>
                    @error('note')
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

<script>
function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan ; 
}

function calculateTotal() {
    const weight = parseFloat(document.getElementById('weight').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const packetPrice = parseFloat(document.getElementById('packetPrice').value) || 0;

    let totalPayment = weight * packetPrice;
    let totalDiscount = (discount / 100) * totalPayment;
    totalPayment -= totalDiscount;
    document.getElementById('total_payment').value = formatRupiah(totalPayment.toFixed(2));
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('weight').addEventListener('input', calculateTotal);
    document.getElementById('discount').addEventListener('input', calculateTotal);
    document.getElementById('cd_packets').addEventListener('change', function() {
        const packetPrice = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('packetPrice').value = packetPrice;
        calculateTotal();
    });
});
</script>



@endsection
