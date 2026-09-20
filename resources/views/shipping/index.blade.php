<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $layanan_header }}</title>
</head>
<body>
    <h2>{{ $layanan_header }}</h2>
    
    <form method="POST" action="{{ route('shipping.calculate') }}">
        {{-- Token keamanan CSRF (Wajib di Laravel untuk form POST) --}}
        @csrf 
        
        <label>Jarak Pengiriman (KM):</label>
        {{-- Value menggunakan old() agar input tidak hilang saat form disubmit --}}
        <input type="number" step="0.1" name="jarak" value="{{ old('jarak', $jarak ?? '') }}" required><br>
        
        <label>Jenis Layanan:</label>
        <input type="radio" name="prioritas" value="reguler" {{ old('prioritas', $prioritas ?? 'reguler') === 'reguler' ? 'checked' : '' }}> Reguler
        <input type="radio" name="prioritas" value="express" {{ old('prioritas', $prioritas ?? '') === 'express' ? 'checked' : '' }}> Express<br>
        
        <button type="submit">Kalkulasi Ongkos Kirim</button>
    </form>

    {{-- Mengecek apakah ada hasil kalkulasi yang dikirim dari Controller --}}
    @if(isset($total_ongkir) && $total_ongkir > 0)
        <hr>
        <h3>Hasil Estimasi Biaya:</h3>
        <p>Layanan: {{ $tipe_layanan }}</p>
        <p><strong>Total Biaya Kirim: Rp {{ number_format($total_ongkir, 0, ',', '.') }}</strong></p>
    @endif
</body>
</html>