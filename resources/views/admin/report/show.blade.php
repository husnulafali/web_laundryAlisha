<!DOCTYPE html>
<html>
<head>
    <title>{{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}-{{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        th, td {
            text-align: center; 
        }

        .invoice {
            margin: 20px;
            padding: 20px;
                    
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
      
        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items th, 
        .invoice-items td {
    max-width: 300px; 
    border: 1px solid #ccc;
    padding: 10px;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
}

.invoice-items th {
    background-color:  #00FFFF !important;
 
}

        @media print {
            .print-button {
                display: none; 
            }
            th {
            background-color: #0000FF;
           
        }
        }
        
  

    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Alisha Laundry</h1>
            <h2>Laporan Order</h2>
            <p style="font-size:20px;">Dari tanggal {{ \Carbon\Carbon::parse($start_date)->format('d F Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</p>
             <a href="javascript:window.print();" class="print-button print-only" style="padding: 5px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; cursor: pointer;">
              Cetak
              </a>
        </div>
        
        <div class="invoice-items">
            <table>
                <thead>
                    <tr> 
                        <th>Tanggal Order</th>
                        <th>Kode Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Paket</th>
                        <th>Berat</th>
                        <th>Total Bayar</th>
                        <th>Status Bayar</th>
                        <th>Status Laundry</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($report as $index => $report)
                    <tr> 
                    <td>{{ \Carbon\Carbon::parse($report->order_date)->format('d F Y') }}</td>
                        <td>{{ $report->cd_orders }}</td>
                        <td>{{ $report->customers->customer_name }}</td>
                        <td>{{ $report->packets->packet_name }}</td>
                        <td>{{ $report->weight }} /Kg</td>
                        <td>Rp.{{ number_format($report->total_payment, 2) }}</td>
                        <td>{{ $report->payment_status }}</td>
                        <td>{{ $report->laundry_status}}</td>
                       @endforeach
                    </tr>               
                </tbody>
            </table>
        </div>
    </div>

    
    
</body>
</html>