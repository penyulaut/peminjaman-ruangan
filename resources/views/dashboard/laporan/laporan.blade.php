<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/bukti-peminjaman.css') }}">
    <title>Bukti Peminjaman Ruangan</title>
</head>

<body>
    <div class="box">
        <div class="header">
            <img src="{{ asset('img/logo.png') }}" alt="Logo UNTIRTA">
                <div class="text">
                    <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
                    <h2>UNIVERSITAS SULTAN AGENG TIRTAYASA</h2>
                    <p>Fakultas Teknik - Jl. Jenderal Sudirman KM.3, Cilegon, Banten</p>
                    <p>Website: www.untirta.ac.id | Email: info@untirta.ac.id</p>
                </div>
        </div>

        <h2 class="title">Bukti Peminjaman Ruangan</h2>

        <p><strong>Nama Peminjam:</strong> {{ $rent->user->name }}</p>
        <p><strong>Ruangan:</strong> {{ $rent->room->code }}</p>
        <p><strong>Tujuan:</strong> {{ $rent->purpose }}</p>
        <p><strong>Mulai:</strong> {{ $rent->time_start_use }}</p>
        <p><strong>Selesai:</strong> {{ $rent->time_end_use }}</p>
        <p><strong>Waktu Transaksi:</strong> {{ $rent->transaction_start }}</p>

        <div class="signature">
            Cilegon, {{ date('d M Y') }}<br>
            Penanggung Jawab<br><br><br>
            <strong><u>......................................</u></strong>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
