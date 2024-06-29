<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 

    <title>Surat Masuk</title>
  </head>
  <body>
    
    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="text-center">Laporan Surat Masuk</h4>
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>No. Surat</th>
                            <th>Pengirim</th>
                            <th style="text-align: center">Tanggal</th>
                            <th style="text-align: center">Diterima</th>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($item as $letter)
                            <tr>
                                <td>{{ $no++; }}</td>
                                <td>{{ $letter->letter_no }}</td>
                                <td>{{ $letter->sender->name }}</td>
                                <td style="text-align: center">{{ date('d-m-Y', strtotime($letter->letter_date)) }}</td>
                                <td style="text-align: center">{{ date('d-m-Y', strtotime($letter->date_received)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.print();
        window.onafterprint = window.close;
    </script>

     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   
  </body>
</html>


<!-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Keterangan</title>
    <style>
      body {
        font-family: 'Times New Roman', Times, serif;
        line-height: 1.6;
        margin: 40px;
      }
      .underline {
        text-decoration: underline;
      }
      .text-center {
        text-align: center;
      }
      .mt-4 {
        margin-top: 20px;
      }
      /* .signature {
        margin-top: 40px;
        text-align: right;
      }  */
      .logo {
        position: absolute;
        top: 20px;
        left: 40px;
        width: 100px;
        height: 100px;
    }

    </style>
  </head>
  <body>
    <img src="logo.png" alt="Logo perusahaan" class="logo">
    <h2 class="text-center underline">SURAT KETERANGAN</h2>
    <p class="text-center">No. 1366/D.II/P/BPR-EB/IV/2024</p>

    <p>Yang bertanda tangan dibawah ini :</p>
    <blockquote>
      <p>
        Nama    : DWIATMODJO BAHAGIO, SP<br>
        Jabatan : Direktur Yang Membawahkan Fungsi Kepatuhan PT. BPR EKADHARMA BHINARAHARJA<br>
        Alamat  : Jl. Raya Jaranan -- Ngadirejo, Kawedanan, Magetan
      </p>
    </blockquote>

    <p>Menerangkan bahwa SHM :</p>
    <blockquote>
      <p>
        Sertifikat Hak Milik Nomor : 403/Desa Bogem, seluas 4970 m² (Empat Ribu Sembilan Ratus Tujuh Puluh Meter Persegi), terletak di Desa Bulugledeg, Kecamatan Bendo, Kabupaten Magetan, Provinsi Jawa Timur, terdaftar atas nama Kartowirjo Dogol.
      </p>
    </blockquote>

    <p>Bukan merupakan jaminan kredit di PT. BPR EKADHARMA BHINARAHARJA.</p>

    <p>Demikian surat keterangan ini kami buat dengan sebenarnya.</p>

    <div class="signature">
      <p>
        Magetan, 29 April 2024<br>
        PT. BPR EKADHARMA BHINARAHARJA<br><br><br>
        <span class="underline">DWIATMODJO BAHAGIO, SP</span><br>
        Direktur Yang Membawahkan Fungsi Kepatuhan
      </p>
    </div>

    <div class="mt-4">
      <p class="underline">Tembusan :</p>
      <ol>
        <li>Arsip</li>
      </ol>
    </div>

    <script>
      window.print();
      window.onafterprint = window.close;
    </script>
  </body>
</html> -->