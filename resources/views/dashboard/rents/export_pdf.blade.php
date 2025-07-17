<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .date { font-size: 14px; margin-bottom: 10px; }
        .filter-info { margin-bottom: 15px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 12px;
            color: white;
        }
        .bg-warning { background-color: #ffc107; }
        .bg-primary { background-color: #007bff; }
        .bg-success { background-color: #28a745; }
        .bg-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Peminjaman</div>        
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Ruangan</th>
                <th>Peminjam</th>
                <th>Mulai Pinjam</th>
                <th>Selesai Pinjam</th>
                <th>Tujuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rents as $index => $rent)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $rent->room->kode }}</td>
                <td>{{ $rent->user->name }}</td>
                <td>{{ $rent->time_start_use }}</td>
                <td>{{ $rent->time_end_use }}</td>
                <td>{{ $rent->purpose }}</td>
                <td>
                    <span class="badge 
                        @if($rent->status == 'pending') bg-warning
                        @elseif($rent->status == 'dipinjam') bg-primary
                        @elseif($rent->status == 'selesai') bg-success
                        @else bg-secondary @endif">
                        {{ $rent->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>