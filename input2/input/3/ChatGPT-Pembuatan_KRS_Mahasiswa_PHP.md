# Pembuatan KRS Mahasiswa PHP

#### You:
Mata kuliah : Pemograman web
sudah belajar tentang html, css, javascript, php dan bootstrap

tolong kerjakaan laporan saya:
Hasil pengerjaan laporan praktikum akan berupa penjelasan
Hasil screenshot coding dan running file wajib diberikan watermark. Jelaskan juga 
Langkah-langkah pengerjaan coding. 
Soal : 
Buatlah sebuah website dengan koneksi PHP yang berisi form pembuatan 
kartu mahasiswa dan kartu rencana studi mahasiswa tersebut dapat 
ditampilkan di halaman lain. Kartu tersebut harus memuat tabel berisi 
informasi mahasiswa dengan enam kolom yaitu:  
a. NIM  
b. Nama Mahasiswa  
c. Nama Mata Kuliah  
d. Nama Dosen  
e. Jumlah SKS  
f. Tahun Pengambilan 
Gunakan Bootstrap dan JavaScript untuk mempercantik tampilan dan 
meningkatkan interaktivitas website.


gunakan bahasa indonesia dalam kodenya, dan saya hanya ingin 2 file, index.php dan koneksi.php

#### ChatGPT:
Berikut adalah solusi untuk soal yang diberikan dengan dua file yaitu `index.php` dan `koneksi.php`.

### 1. File `koneksi.php`

File ini digunakan untuk menghubungkan website dengan database MySQL.

```php
<?php
$servername = "localhost";  // Ganti dengan server Anda
$username = "root";         // Ganti dengan username MySQL Anda
$password = "";             // Ganti dengan password MySQL Anda
$dbname = "mahasiswa";      // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
```

### 2. File `index.php`

File ini berisi form untuk menginput data mahasiswa dan menampilkan kartu rencana studi mahasiswa.

```php
<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi Mahasiswa</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Form Pembuatan Kartu Rencana Studi Mahasiswa</h2>

        <!-- Form Input Data Mahasiswa -->
        <form action="index.php" method="POST">
            <div class="card">
                <div class="card-header">
                    <strong>Input Data Mahasiswa</strong>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mata_kuliah" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mata_kuliah" name="nama_mata_kuliah" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
                        <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_pengambilan" class="form-label">Tahun Pengambilan</label>
                        <input type="number" class="form-control" id="tahun_pengambilan" name="tahun_pengambilan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>

        <?php
        // Simpan data yang dimasukkan
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nim = $_POST['nim'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $nama_mata_kuliah = $_POST['nama_mata_kuliah'];
            $nama_dosen = $_POST['nama_dosen'];
            $jumlah_sks = $_POST['jumlah_sks'];
            $tahun_pengambilan = $_POST['tahun_pengambilan'];

            // Query untuk menyimpan data ke database
            $sql = "INSERT INTO kartu_rencana_studi (nim, nama_mahasiswa, nama_mata_kuliah, nama_dosen, jumlah_sks, tahun_pengambilan) 
                    VALUES ('$nim', '$nama_mahasiswa', '$nama_mata_kuliah', '$nama_dosen', '$jumlah_sks', '$tahun_pengambilan')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Data berhasil disimpan!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        // Tampilkan tabel data mahasiswa
        $sql = "SELECT * FROM kartu_rencana_studi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3 class='text-center mt-5'>Kartu Rencana Studi Mahasiswa</h3>";
            echo "<table class='table table-bordered mt-3'>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nama Dosen</th>
                            <th>Jumlah SKS</th>
                            <th>Tahun Pengambilan</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['nim'] . "</td>
                        <td>" . $row['nama_mahasiswa'] . "</td>
                        <td>" . $row['nama_mata_kuliah'] . "</td>
                        <td>" . $row['nama_dosen'] . "</td>
                        <td>" . $row['jumlah_sks'] . "</td>
                        <td>" . $row['tahun_pengambilan'] . "</td>
                    </tr>";
            }
            echo "</tbody>
                </table>";
        } else {
            echo "<div class='alert alert-warning mt-3'>Tidak ada data.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
```

### Penjelasan Langkah-langkah Pengerjaan:

1. **Buat file `koneksi.php`**:
   - Menggunakan `mysqli` untuk membuat koneksi ke database.
   - Pastikan Anda sudah membuat database `mahasiswa` dan tabel `kartu_rencana_studi` dengan kolom yang sesuai.

2. **Buat file `index.php`**:
   - Membuat form input dengan field yang sesuai untuk data mahasiswa.
   - Menggunakan `POST` untuk mengirim data ke server dan menyimpannya ke database.
   - Menampilkan data yang sudah disimpan dalam tabel dengan menggunakan query `SELECT`.

3. **Desain dengan Bootstrap**:
   - Menggunakan kelas Bootstrap untuk membuat tampilan form dan tabel agar lebih rapi dan interaktif.

4. **Penggunaan JavaScript dan jQuery**:
   - Digunakan untuk meningkatkan interaktivitas pada tampilan, meskipun dalam kasus ini, hanya Bootstrap yang digunakan untuk tampilan.

5. **Simpan dan Tampilkan Data**:
   - Data yang dimasukkan akan disimpan ke database dan bisa ditampilkan dalam tabel di halaman yang sama.

6. **Watermark**:
   - Pastikan Anda menambahkan watermark pada hasil screenshot coding dan running file sesuai instruksi.

Jangan lupa untuk menyesuaikan koneksi database di `koneksi.php` dengan konfigurasi lokal Anda.


#### You:
dmn query sql nya ?

#### ChatGPT:
Maaf atas kelupaan saya sebelumnya! Berikut adalah query SQL untuk membuat database dan tabel yang diperlukan agar aplikasi bisa berjalan dengan baik.

### 1. Query untuk Membuat Database

```sql
CREATE DATABASE mahasiswa;
```

### 2. Query untuk Membuat Tabel `kartu_rencana_studi`

```sql
USE mahasiswa;

CREATE TABLE kartu_rencana_studi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    nama_mata_kuliah VARCHAR(100) NOT NULL,
    nama_dosen VARCHAR(100) NOT NULL,
    jumlah_sks INT NOT NULL,
    tahun_pengambilan YEAR NOT NULL
);
```

### Penjelasan:

- **Database**: `mahasiswa` - tempat penyimpanan data mahasiswa.
- **Tabel `kartu_rencana_studi`**:
  - **id**: Kolom ini digunakan sebagai primary key dengan auto increment untuk setiap entri.
  - **nim**: Kolom untuk menyimpan NIM mahasiswa.
  - **nama\_mahasiswa**: Kolom untuk nama mahasiswa.
  - **nama\_mata\_kuliah**: Kolom untuk nama mata kuliah.
  - **nama\_dosen**: Kolom untuk nama dosen.
  - **jumlah\_sks**: Kolom untuk jumlah SKS yang diambil oleh mahasiswa.
  - **tahun\_pengambilan**: Kolom untuk tahun pengambilan mata kuliah.

Setelah menjalankan query SQL ini di MySQL, Anda dapat melanjutkan dengan kode PHP yang sudah saya berikan sebelumnya.

Jika Anda sudah memiliki database yang ada, Anda hanya perlu menjalankan query untuk membuat tabel tersebut.


#### You:
dan query isi datanya 3 saja

#### ChatGPT:
Tentu! Berikut adalah query SQL untuk mengisi data pada tabel `kartu_rencana_studi` dengan tiga entri contoh:

### Query untuk Menambahkan Data (3 Contoh)

```sql
INSERT INTO kartu_rencana_studi (nim, nama_mahasiswa, nama_mata_kuliah, nama_dosen, jumlah_sks, tahun_pengambilan)
VALUES
('1234567890', 'Ahmad Fauzi', 'Pemrograman Web', 'Dr. Ahmad Zulkifli', 3, 2024),
('2345678901', 'Budi Santoso', 'Algoritma dan Pemrograman', 'Prof. Rina Suharti', 4, 2024),
('3456789012', 'Citra Dewi', 'Basis Data', 'Dr. Joko Prasetyo', 3, 2024);
```

### Penjelasan:

- **NIM**: Identitas mahasiswa, misalnya `1234567890`.
- **Nama Mahasiswa**: Nama lengkap mahasiswa.
- **Nama Mata Kuliah**: Nama mata kuliah yang diambil mahasiswa.
- **Nama Dosen**: Nama dosen pengampu mata kuliah.
- **Jumlah SKS**: Jumlah SKS yang diambil untuk mata kuliah tersebut.
- **Tahun Pengambilan**: Tahun pengambilan mata kuliah.

Setelah menjalankan query ini, Anda akan memiliki tiga data mahasiswa yang dapat ditampilkan di halaman website Anda.

Jangan lupa untuk menyesuaikan data sesuai dengan kebutuhan Anda!


#### You:
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nim = $_POST['nim'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $nama_mata_kuliah = $_POST['nama_mata_kuliah'];
            $nama_dosen = $_POST['nama_dosen'];
            $jumlah_sks = $_POST['jumlah_sks'];
            $tahun_pengambilan = $_POST['tahun_pengambilan'];

            // Query untuk menyimpan data ke database
            $sql = "INSERT INTO kartu_rencana_studi (nim, nama_mahasiswa, nama_mata_kuliah, nama_dosen, jumlah_sks, tahun_pengambilan) 
                    VALUES ('$nim', '$nama_mahasiswa', '$nama_mata_kuliah', '$nama_dosen', '$jumlah_sks', '$tahun_pengambilan')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Data berhasil disimpan!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

jelaskan dengan singkat padat jelas, langsung inti nya saja

#### ChatGPT:
Kode di atas adalah bagian untuk menangani form yang dikirim dengan metode `POST`. Berikut adalah penjelasannya:

1. **Cek Metode Request**: `$_SERVER['REQUEST_METHOD'] == 'POST'` memastikan bahwa form dikirim menggunakan metode POST.
2. **Ambil Data Inputan**: Data yang dimasukkan pada form (`nim`, `nama_mahasiswa`, `nama_mata_kuliah`, dll.) disimpan ke dalam variabel PHP.
3. **Query SQL**: Data yang diambil dimasukkan ke dalam query SQL `INSERT INTO` untuk disimpan ke tabel `kartu_rencana_studi` dalam database.
4. **Eksekusi Query**: `if ($conn->query($sql) === TRUE)` menjalankan query dan memeriksa apakah berhasil.
5. **Pesan Keberhasilan/Gagal**: Jika query berhasil, menampilkan pesan sukses. Jika gagal, menampilkan pesan error.


#### You:
paragraf

#### ChatGPT:
Kode di atas berfungsi untuk menangani pengiriman data form menggunakan metode `POST`. Ketika form dikirim, data yang dimasukkan (seperti NIM, nama mahasiswa, nama mata kuliah, nama dosen, jumlah SKS, dan tahun pengambilan) diambil dan disimpan dalam variabel PHP. Kemudian, data tersebut dimasukkan ke dalam query SQL `INSERT INTO` untuk disimpan dalam tabel `kartu_rencana_studi` di database. Setelah itu, kode memeriksa apakah query berhasil dieksekusi. Jika berhasil, maka akan menampilkan pesan sukses kepada pengguna, sedangkan jika gagal, akan menampilkan pesan kesalahan yang berisi detail error dari query yang dijalankan.


#### You:
sekarang yang ini

 $sql = "SELECT * FROM kartu_rencana_studi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3 class='text-center mt-5'>Kartu Rencana Studi Mahasiswa</h3>";
            echo "<table class='table table-bordered mt-3'>
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nama Dosen</th>
                            <th>Jumlah SKS</th>
                            <th>Tahun Pengambilan</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['nim'] . "</td>
                        <td>" . $row['nama_mahasiswa'] . "</td>
                        <td>" . $row['nama_mata_kuliah'] . "</td>
                        <td>" . $row['nama_dosen'] . "</td>
                        <td>" . $row['jumlah_sks'] . "</td>
                        <td>" . $row['tahun_pengambilan'] . "</td>
                    </tr>";
            }
            echo "</tbody>
                </table>";
        } else {
            echo "<div class='alert alert-warning mt-3'>Tidak ada data.</div>";
        }

#### ChatGPT:
Kode di atas berfungsi untuk mengambil dan menampilkan data dari tabel `kartu_rencana_studi` di database. Berikut penjelasan singkatnya:

1. **Query SELECT**: `SELECT * FROM kartu_rencana_studi` mengambil semua data dari tabel `kartu_rencana_studi`.
2. **Eksekusi Query**: ` $result = $conn->query($sql)` menjalankan query dan menyimpan hasilnya dalam variabel `$result`.
3. **Cek Data Ada**: `if ($result->num_rows > 0)` memeriksa apakah ada data yang ditemukan. Jika ada, maka dilanjutkan untuk menampilkan data dalam bentuk tabel HTML.
4. **Membuat Tabel**: Dalam bagian `while`, setiap baris data (`$row`) ditampilkan dalam tabel HTML, dengan setiap kolom diisi oleh nilai dari kolom yang sesuai di database.
5. **Pesan Jika Tidak Ada Data**: Jika tidak ada data (`num_rows == 0`), maka akan menampilkan pesan peringatan bahwa tidak ada data yang ditemukan.

Dengan menggunakan Bootstrap, tabel dan pesan tampilannya lebih rapi dan responsif.


#### You:
paragraf

#### ChatGPT:
Kode di atas berfungsi untuk mengambil data dari tabel `kartu_rencana_studi` di database dan menampilkannya dalam bentuk tabel HTML. Pertama, query `SELECT * FROM kartu_rencana_studi` digunakan untuk mengambil seluruh data yang ada dalam tabel. Setelah itu, query dijalankan menggunakan `$conn->query($sql)` dan hasilnya disimpan dalam variabel `$result`. Jika data ditemukan (`$result->num_rows > 0`), kode akan membuat sebuah tabel dengan menggunakan Bootstrap, yang menampilkan informasi mahasiswa seperti NIM, nama mahasiswa, nama mata kuliah, nama dosen, jumlah SKS, dan tahun pengambilan. Setiap baris data ditampilkan dalam elemen tabel `<tr>`. Namun, jika tidak ada data yang ditemukan, maka pesan peringatan "Tidak ada data" akan ditampilkan. Dengan demikian, kode ini memungkinkan pengguna untuk melihat daftar kartu rencana studi mahasiswa yang tersimpan dalam database secara dinamis.
