<!DOCTYPE html>
<html>
<head>
    <title>Invoice-{{ $order->cd_orders }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon-16x16.png')}}">
 
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .invoice {
        max-width: 200px; 
        margin: 0 auto;
        text-align: left;
        padding: 10px;
    }

    .invoice-logo img {
        max-width: 80px; 
    }

    .invoice-header {
        text-align: center;
    }

    .invoice-details p {
        margin: 5px 0;
    }

    .invoice-items {
        margin-top: 10px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000; 
        padding: 5px 0;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #000; 
    }

    .item-name {
        flex: 2;
        font-size: 12px;
        max-width: 50%; 
        padding: 5px;
        word-wrap: break-word; 
        white-space: pre-wrap; 
    }

    .item-quantity, .item-price {
        flex: 2; 
        text-align: right;
        font-size: 12px;
        max-width: 50%; 
        padding: 5px;
        word-wrap: break-word; 
        white-space: pre-wrap; 
    }

    .invoice-total {
        margin-top: 10px;
        text-align: right;
    }
   
    @media screen and (max-width: 320px) {
        .invoice {
            max-width: 100%; 
            padding: 5px;
        }

        .invoice-details p, .item-name, .item-quantity, .item-price, .invoice-total p {
            font-size: 10px;
        }
    }
    @media print {
        .print-button {
            display: none; 
        }
        .invoice-total {
            page-break-after: always; 
        }
    }
    
    .invoice-footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        border-top: 1px solid #000;
        padding-top: 10px;
        background-color: #f8f8f8;
    }

    .invoice-footer p {
        margin: 5px 0;
        color: #333;
    }

   
    .print-button {
        display: block;
        margin: 20px auto;
        padding: 5px;
        width: 80px;
        background-color: #008CBA;
        color: #fff;
        border: none;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
    }

    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h2 style="margin-bottom: -10px;">Alisha Laundry</h1>
            <p style="font-size: 13px; margin-bottom: -10px;">Barat Pasar Wit-witan</p>
            <p style="font-size: 12px;">Telp. (08234567890)</p>
        </div>

        <div class="invoice-details" style="font-size: 12px; max-width: 100%; word-wrap: break-word;">
            <p style="font-weight: bold;">Kode Order: {{ $order->cd_orders }}</p>
            <p>Tanggal Order: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->order_date)->format('d/m/Y H:i') }}</p>
            <p>Nama: {{ $order->customers->customer_name }}</p>
            <p>Status: {{ $order->payment_status }}</p>
            <p>Nama Petugas: {{ $user->name }}</p>

            <div class="invoice-items">
                <div class="item-row">
                    <div class="item-name">Jenis Paket:</div>
                    <div class="item-quantity">{{ $order->packets->packet_name }}</div>
                </div>
                <div class="item-row">
                    <div class="item-name">Harga Paket:</div>
                    <div class="item-quantity">Rp.{{ number_format($order->packets->price, 2) }}</div>
                </div>
                <div class="item-row">
                    <div class="item-name">Berat:</div>
                    <div class="item-quantity">{{ $order->weight }}/Kg</div>
                </div>
                <div class="item-row">
                    <div class="item-name">Diskon:</div>
                    <div class="item-quantity">@if (isset($order->discount)){{ $order->discount }} % @else <span>-</span> @endif</div>
                </div>
            </div>

            <div class="invoice-total">
                <p style="font-weight: bold; font-size: 13px;">Total: Rp.{{ number_format($order->total_payment, 2) }}</p>
            </div>

            <div class="invoice-footer">
                <p><strong>Terima kasih telah mempercayakan laundry Anda kepada kami.</strong></p>
                <p>Harap simpan struk ini sebagai bukti pengambilan.</p>
            </div>
        </div>

        <a href="javascript:window.print();" class="print-button print-only">
            Cetak
        </a>
    </div>

    <script>
        function printAndCut() {
            const cutCommand = '\x1D\x56\x00'; 
            window.close();
        }
    </script>
</body>
</html>
