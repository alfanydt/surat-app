<!-- resources/views/letters/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Surat Permohonan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: right; margin-bottom: 20px; }
        .content { margin: 20px; }
        .signature { margin-top: 40px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <p>{{ now()->format('d F Y') }}</p>
    </div>
    <div class="content">
        <p>Kepada Yth :</p>
        <p>Direksi PT. BPR EKADHARMA BHINARAHARJA</p>
        <p>Di Kawedanan - Magetan</p>
        <p>Dengan hormat,</p>
        <p>Yang bertanda tangan dibawah ini:</p>
        <p>Nama: {{ $letter->sender->name }}</p>
        <p>Jabatan: {{ $letter->sender->position }}</p>
        <p>Sehubungan dengan {{ $letter->regarding }}, dengan ini kami mengajukan permohonan {{ $letter->letter_type }} dengan rincian sebagai berikut:</p>
        <!-- Add your custom letter content here -->
    </div>
    <div class="signature">
        <p>Disetujui,</p>
        <p>Kepala Cabang</p>
        <p>Yang mengajukan,</p>
        <p>TUTUT SRI WAHYU MURTI, SE</p>
        <p>Kabag. Operasional</p>
        <p>Mengetahui dan menyetujui,</p>
        <p>Direksi</p>
        <p>DWIATMODJO BAHAGIO, SP</p>
        <p>Direktur Yang Membawahkan Fungsi Kepatuhan</p>
    </div>
</body>
</html>
