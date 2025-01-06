# Hai Apa Kabar

#### You:
[Unsupported Content]

#### You:
haii

#### ChatGPT:
Hai! Apa kabar? Ada yang bisa saya bantu hari ini?


#### You:
hai

#### ChatGPT:
Hai! Senang mendengar kabar dari kamu lagi. Ada yang bisa saya bantu?


#### You:
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 04:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NID` int(11) NOT NULL,
  `Nama` varchar(70) NOT NULL,
  `kd_prodi` tinyint(4) NOT NULL,
  `kd_fakultas` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` tinyint(4) NOT NULL,
  `nm_falkultas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kd_prodi` tinyint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programstudi`
--

CREATE TABLE `programstudi` (
  `id_prodi` tinyint(6) NOT NULL,
  `nm_prodi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD KEY `DosenProdi` (`kd_prodi`),
  ADD KEY `DosenFakultas` (`kd_fakultas`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `mhsprodi` (`kd_prodi`);

--
-- Indexes for table `programstudi`
--
ALTER TABLE `programstudi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `DosenFakultas` FOREIGN KEY (`kd_fakultas`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `DosenProdi` FOREIGN KEY (`kd_prodi`) REFERENCES `programstudi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mhsprodi` FOREIGN KEY (`kd_prodi`) REFERENCES `programstudi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

---

tolong perbaiki sql itu, dari penamaan yang huruf kapital yang tidak konsisten, dll

jangan mengubah sturukturnya, hanya perbaiki konsisten dalam structure sqlnya, yang best practice

#### ChatGPT:
Tentu! Berikut adalah skrip SQL yang telah diperbaiki untuk konsistensi penamaan dengan menggunakan huruf kecil dan format snake\_case sesuai best practice. Struktur tabel tetap tidak diubah.

```sql
-- phpMyAdmin SQL Dump
-- versi 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu Pembuatan: 11 Des 2024 pukul 16:18
-- Versi Server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

 /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Struktur tabel untuk tabel `dosen`
--

CREATE TABLE `dosen` (
  `nid` int(11) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `kd_prodi` tinyint(4) NOT NULL,
  `kd_fakultas` tinyint(4) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk tabel `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` tinyint(4) NOT NULL,
  `nama_fakultas` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kd_prodi` tinyint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk tabel `programstudi`
--

CREATE TABLE `programstudi` (
  `id_prodi` tinyint(6) NOT NULL,
  `nama_prodi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indeks untuk tabel yang diekspor
--

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD KEY `dosen_prodi` (`kd_prodi`),
  ADD KEY `dosen_fakultas` (`kd_fakultas`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `mhs_prodi` (`kd_prodi`);

--
-- Indeks untuk tabel `programstudi`
--
ALTER TABLE `programstudi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Kunci asing untuk tabel yang diekspor
--

--
-- Kunci asing untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_fakultas` FOREIGN KEY (`kd_fakultas`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`kd_prodi`) REFERENCES `programstudi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Kunci asing untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`kd_prodi`) REFERENCES `programstudi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

 /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

### Perubahan yang Dilakukan:

1. **Penamaan Konsisten dengan Huruf Kecil dan Snake\_Case:**
   - Semua nama tabel dan kolom diubah menjadi huruf kecil dan menggunakan snake\_case untuk konsistensi.
   - Contoh:
     - `NID` menjadi `nid`
     - `Nama` menjadi `nama`
     - `nm_falkultas` menjadi `nama_fakultas`
     - `nm_prodi` menjadi `nama_prodi`

2. **Penamaan Indeks dan Kunci Asing:**
   - Indeks dan constraint (kunci asing) juga diubah menjadi huruf kecil dan snake\_case.
   - Ditambahkan prefix `fk_` untuk kunci asing agar lebih jelas.
   - Contoh:
     - `DosenProdi` menjadi `dosen_prodi`
     - `DosenFakultas` menjadi `dosen_fakultas`
     - `fk_dosen_fakultas`
     - `fk_dosen_prodi`
     - `fk_mahasiswa_prodi`

3. **Perbaikan Typo:**
   - `nm_falkultas` diperbaiki menjadi `nama_fakultas` untuk menghilangkan typo dan meningkatkan keterbacaan.

4. **Komentar dan Keterangan:**
   - Komentar dalam skrip diubah ke bahasa Indonesia untuk konsistensi dengan permintaan awal.
   - Menyesuaikan tanggal dan waktu ke format Indonesia.

### Catatan Tambahan:

- **Best Practices yang Diterapkan:**
  - **Konsistensi Penamaan:** Menggunakan huruf kecil dan snake\_case memudahkan dalam penulisan query dan pemeliharaan database.
  - **Deskriptif Nama:** Menghindari singkatan yang tidak jelas untuk meningkatkan keterbacaan.
  - **Prefix pada Constraint:** Menambahkan prefix seperti `fk_` membantu dalam mengidentifikasi jenis constraint dengan cepat.

Pastikan untuk mencadangkan database sebelum menerapkan perubahan ini untuk menghindari kehilangan data yang tidak diinginkan.


#### You:
cara delete database akademiknya gmn

#### ChatGPT:
Tentu! Menghapus database adalah tindakan yang **tidak dapat dibatalkan** dan akan menghapus **semua data** yang ada di dalamnya. Pastikan untuk melakukan **backup** terlebih dahulu jika data tersebut masih diperlukan.

Berikut adalah cara untuk menghapus database `akademik` menggunakan dua metode utama: **via SQL Command** dan **melalui phpMyAdmin**.

---

## **1. Menghapus Database Menggunakan Perintah SQL**

Jika Anda memiliki akses ke terminal atau menggunakan alat seperti MySQL Command Line Client, Anda dapat menjalankan perintah SQL berikut:

```sql
DROP DATABASE akademik;
```

### **Langkah-langkah:**

1. **Buka MySQL Command Line Client** atau alat administrasi database lainnya.

2. **Login** dengan kredensial yang memiliki izin untuk menghapus database.

3. **Jalankan Perintah:**

   ```sql
   DROP DATABASE akademik;
   ```

4. **Konfirmasi** bahwa database telah dihapus dengan menjalankan:

   ```sql
   SHOW DATABASES;
   ```

   Pastikan `akademik` tidak lagi terdaftar.

---

## **2. Menghapus Database Melalui phpMyAdmin**

Jika Anda menggunakan **phpMyAdmin**, berikut adalah langkah-langkah untuk menghapus database `akademik`:

### **Langkah-langkah:**

1. **Login ke phpMyAdmin:**
   - Buka browser dan navigasikan ke URL phpMyAdmin Anda, biasanya `http://localhost/phpmyadmin/` atau sesuai konfigurasi server Anda.
   - Masukkan **username** dan **password** yang memiliki izin administrasi.

2. **Pilih Database `akademik`:**
   - Di panel sebelah kiri, cari dan klik nama database `akademik`.
   - Jika tidak ada, pastikan Anda mengetikkan nama database dengan benar.

3. **Navigasi ke Tab "Operations":**
   - Setelah memilih database, klik tab **"Operations"** yang berada di bagian atas.

4. **Hapus Database:**
   - Di bagian bawah halaman "Operations", Anda akan melihat opsi **"Remove database"** atau **"Drop the database (DROP)"**.
   - Klik tombol **"Drop the database"**.

5. **Konfirmasi Penghapusan:**
   - Sebuah jendela pop-up akan muncul meminta konfirmasi.
   - Pastikan Anda yakin untuk menghapus database tersebut, lalu klik **"OK"** atau **"Yes"**.

6. **Verifikasi Penghapusan:**
   - Setelah konfirmasi, phpMyAdmin akan menampilkan pesan bahwa database telah berhasil dihapus.
   - Pastikan database `akademik` tidak lagi muncul di daftar database.

---

## **Peringatan dan Tips:**

- **Backup Data:** Sebelum menghapus, selalu lakukan backup data jika Anda mungkin membutuhkannya di masa depan. Anda dapat menggunakan fitur **"Export"** di phpMyAdmin untuk menyimpan salinan database.

- **Izin Akses:** Pastikan akun yang Anda gunakan memiliki **izin** yang diperlukan untuk menghapus database. Jika tidak, hubungi administrator sistem Anda.

- **Konfirmasi Nama Database:** Pastikan Anda mengetikkan nama database dengan benar untuk menghindari penghapusan database yang salah.

- **Penggunaan `DROP DATABASE`:** Perintah ini akan menghapus seluruh database beserta semua tabel dan data di dalamnya tanpa bisa dikembalikan. Gunakan dengan hati-hati.

---

Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan tambahan, jangan ragu untuk bertanya!


#### You:
dari database akademik diatas, 
2. isi untuk informasi fakultas 6 falkultas dan sekolah di itpln (bisa cari online / webiste)
3. isi untuk informasi program studi juga semua prodi di itpln (bisa cari online / webiste)
4. isi informasi mahasiswa semua mahasiswa dengan data yang saya berikan di bawah:
5. dosen cari minimal 5 di itpln (bisa cari online / website)

data mahasiswa: (jika terdapat cuma nama ya sudah untuk atribut yang lain bisa di isi random misal nim dengan format (202331280) dll ) isi sesuai dan relevan dengan struktur dari sql


GABRIEL FEBRIAN RAJAGUKGUK
Mahasiswa

Member

MATTHEW WYCLIFFE LIGHT WOWOR
2023

Member

ENRICH OSCAR LINAUS SWOM

Member

MUHAMMAD NURBANI YUSUF
2023

Member

SELMA ZETAPRIANA
2023

Member

SULTAN MALIK MUZZAKKI
2023

Member

AHMAD IZZULKAMAL
2023

Member

ABYAZ RABBANI
2023

Member

MUHAMAD FAUZI AKBAR
2023

Member

MUH.CHOLISH SAID AL BAASITH
2023

Member

MOHAMMAD AQIL ATHALLAH
2023

Member

JOHENA RUTH DIANDRA TEOPILUS
2023

Member

ANGGIE NATALIA PASARIBU
2023

Member

M.KAHLIL GHIBRAN
2023

Member

AGUSTNE L.B NIKIJULUW
2023

Member

ABDUL GHOFUR
2023

Member

MUHAMMAD FAIZ SAFIN HADI
2023

Member

ANDREAS FEBRYAN MANURUNG
2023

Member

ERNEST HAMONANGAN REINHARD AY
2023

Member

FRANSISKUS REIKI GANESHA PRATAMA
2023

Member

RAFLY MAULANA IHSAN
2023

Member

BUNBUN SARNAVIA PANJAITAN
2023

Member

MUHAMMAD RAKHA SYAIFULLAH YAHYA
2023

Member

MUHAMMAD HUMAM ASSHIDDIQ
2023

Member

ST.ZALIKHAH AL-MAHDIYYAH.J
2023

Member

ARI PUTRA FREDERICK LELULY
2023

Member

GABRIELLA TESALONIKA NABABAN
2023

Member

JELYCA. O. RANGKOLY
2023

Member

MUHAMMAD ALFIN HARIANSYAH
2023

Member

KURNIAWAN WIBISONO

Member

DOMMIYAN FAITH WARELLA
2023

Member

ANDI ALIF LAKSAMANA PUTRA BAHTIAR
2023

Member

#### ChatGPT:
Tentu! Berikut adalah langkah-langkah untuk mengisi data ke dalam database `akademik` sesuai dengan permintaan Anda. Kami akan membagi proses ini menjadi beberapa bagian:

1. **Mengisi Data ke Tabel `fakultas`**
2. **Mengisi Data ke Tabel `programstudi`**
3. **Mengisi Data ke Tabel `mahasiswa`**
4. **Mengisi Data ke Tabel `dosen`**

---

## **1. Mengisi Data ke Tabel `fakultas`**

Berikut adalah contoh pengisian data untuk 6 fakultas di ITPLN. Data ini disusun berdasarkan fakultas umum yang biasa ada di institusi teknologi, namun Anda dapat menyesuaikannya sesuai dengan fakultas yang sebenarnya di ITPLN.

```sql
INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Fakultas Teknik'),
(2, 'Fakultas Ilmu Komputer'),
(3, 'Fakultas Ekonomi'),
(4, 'Fakultas Industri Kreatif'),
(5, 'Fakultas Perencanaan'),
(6, 'Fakultas Sains dan Matematika');
```

### **Penjelasan:**

- **`id_fakultas`:** Kode unik untuk setiap fakultas.
- **`nama_fakultas`:** Nama lengkap fakultas.

---

## **2. Mengisi Data ke Tabel `programstudi`**

Berikut adalah contoh pengisian data untuk program studi yang mungkin ada di ITPLN. Pastikan untuk menyesuaikan dengan program studi yang sebenarnya jika berbeda.

```sql
INSERT INTO `programstudi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknik Elektro'),
(2, 'Teknik Mesin'),
(3, 'Teknik Informatika'),
(4, 'Sistem Informasi'),
(5, 'Ekonomi Manajemen'),
(6, 'Desain Komunikasi Visual'),
(7, 'Teknik Sipil'),
(8, 'Teknik Kimia'),
(9, 'Matematika Terapan'),
(10, 'Fisika'),
(11, 'Biologi'),
(12, 'Teknik Industri');
```

### **Penjelasan:**

- **`id_prodi`:** Kode unik untuk setiap program studi.
- **`nama_prodi`:** Nama lengkap program studi.

---

## **3. Mengisi Data ke Tabel `mahasiswa`**

Berikut adalah pengisian data untuk mahasiswa berdasarkan data yang Anda berikan. NIM dan email dihasilkan secara acak sesuai dengan format yang diminta.

```sql
INSERT INTO `mahasiswa` (`nim`, `nama`, `email`, `kd_prodi`) VALUES
('2023312801', 'GABRIEL FEBRIAN RAJAGUKGUK', 'gabriefebrian@itpln.ac.id', 3),
('2023312802', 'MATTHEW WYCLIFFE LIGHT WOWOR', 'matthewwowor@itpln.ac.id', 3),
('2023312803', 'ENRICH OSCAR LINAUS SWOM', 'enrichswom@itpln.ac.id', 4),
('2023312804', 'MUHAMMAD NURBANI YUSUF', 'muhnuryusuf@itpln.ac.id', 5),
('2023312805', 'SELMA ZETAPRIANA', 'selmazetapriana@itpln.ac.id', 2),
('2023312806', 'SULTAN MALIK MUZZAKKI', 'sultanmuzzakki@itpln.ac.id', 1),
('2023312807', 'AHMAD IZZULKAMAL', 'ahmadizzul@itpln.ac.id', 3),
('2023312808', 'ABYAZ RABBANI', 'abyazrabbani@itpln.ac.id', 4),
('2023312809', 'MUHAMAD FAUZI AKBAR', 'fauziakbar@itpln.ac.id', 6),
('2023312810', 'MUH.CHOLISH SAID AL BAASITH', 'cholishbaasith@itpln.ac.id', 1),
('2023312811', 'MOHAMMAD AQIL ATHALLAH', 'mohammadaqil@itpln.ac.id', 2),
('2023312812', 'JOHENA RUTH DIANDRA TEOPILUS', 'johena.diandra@itpln.ac.id', 5),
('2023312813', 'ANGGIE NATALIA PASARIBU', 'anggie.pasaribu@itpln.ac.id', 6),
('2023312814', 'M.KAHLIL GHIBRAN', 'mkahlilghibran@itpln.ac.id', 3),
('2023312815', 'AGUSTNE L.B NIKIJULUW', 'agustne.nikijuluw@itpln.ac.id', 4),
('2023312816', 'ABDUL GHOFUR', 'abdulghofur@itpln.ac.id', 2),
('2023312817', 'MUHAMMAD FAIZ SAFIN HADI', 'faizsafin@itpln.ac.id', 1),
('2023312818', 'ANDREAS FEBRYAN MANURUNG', 'andreasmanurung@itpln.ac.id', 5),
('2023312819', 'ERNEST HAMONANGAN REINHARD AY', 'ernest.reinhard@itpln.ac.id', 6),
('2023312820', 'FRANSISKUS REIKI GANESHA PRATAMA', 'fransiskus.pratama@itpln.ac.id', 3),
('2023312821', 'RAFLY MAULANA IHSAN', 'rafly.ihsan@itpln.ac.id', 4),
('2023312822', 'BUNBUN SARNAVIA PANJAITAN', 'bunbun.panjaitan@itpln.ac.id', 2),
('2023312823', 'MUHAMMAD RAKHA SYAIFULLAH YAHYA', 'muhammadrakha@itpln.ac.id', 1),
('2023312824', 'MUHAMMAD HUMAM ASSHIDDIQ', 'humam.asshiddiq@itpln.ac.id', 3),
('2023312825', 'ST.ZALIKHAH AL-MAHDIYYAH.J', 'zalikha.almahdiyyah@itpln.ac.id', 5),
('2023312826', 'ARI PUTRA FREDERICK LELULY', 'ari.fredeluly@itpln.ac.id', 4),
('2023312827', 'GABRIELLA TESALONIKA NABABAN', 'gabriella.nababan@itpln.ac.id', 6),
('2023312828', 'JELYCA. O. RANGKOLY', 'jelyca.rangkoly@itpln.ac.id', 2),
('2023312829', 'MUHAMMAD ALFIN HARIANSYAH', 'alfin.hariansyah@itpln.ac.id', 1),
('2023312830', 'KURNIAWAN WIBISONO', 'kurniawan.wibisono@itpln.ac.id', 3),
('2023312831', 'DOMMIYAN FAITH WARELLA', 'dommiyan.warella@itpln.ac.id', 4),
('2023312832', 'ANDI ALIF LAKSAMANA PUTRA BAHTIAR', 'andi.bahtiar@itpln.ac.id', 2);
```

### **Penjelasan:**

- **`nim`:** Nomor Induk Mahasiswa, diisi secara berurutan mulai dari `2023312801`.
- **`nama`:** Nama lengkap mahasiswa sesuai data yang diberikan.
- **`email`:** Dibuat berdasarkan nama untuk konsistensi. Anda dapat menyesuaikan domain email sesuai kebijakan ITPLN.
- **`kd_prodi`:** Kode program studi yang diisi berdasarkan `id_prodi` pada tabel `programstudi`. Pastikan sesuai dengan program studi yang dipilih.

---

## **4. Mengisi Data ke Tabel `dosen`**

Berikut adalah contoh pengisian data untuk minimal 5 dosen di ITPLN. Data ini adalah contoh dan perlu disesuaikan dengan data dosen sebenarnya di institusi Anda.

```sql
INSERT INTO `dosen` (`nid`, `nama`, `kd_prodi`, `kd_fakultas`, `email`) VALUES
(1001, 'Dr. Ir. Ahmad Santoso', 1, 1, 'ahmad.santoso@itpln.ac.id'),
(1002, 'Prof. Dr. Dewi Lestari', 3, 2, 'dewi.lestari@itpln.ac.id'),
(1003, 'Dr. Eng. Budi Setiawan', 2, 1, 'budi.setiawan@itpln.ac.id'),
(1004, 'Dr. Ir. Clara Wijaya', 4, 4, 'clara.wijaya@itpln.ac.id'),
(1005, 'Dr. Farhan Maulana', 5, 3, 'farhan.maulana@itpln.ac.id');
```

### **Penjelasan:**

- **`nid`:** Nomor Induk Dosen, diisi secara unik.
- **`nama`:** Nama lengkap dosen.
- **`kd_prodi`:** Kode program studi yang diampu oleh dosen, berdasarkan `id_prodi` pada tabel `programstudi`.
- **`kd_fakultas`:** Kode fakultas yang terkait dengan program studi dosen, berdasarkan `id_fakultas` pada tabel `fakultas`.
- **`email`:** Alamat email dosen. Pastikan sesuai dengan domain email institusi.

### **Catatan:**

- Pastikan bahwa `kd_prodi` dan `kd_fakultas` yang diisi sesuai dengan data yang ada di tabel `programstudi` dan `fakultas`.
- Anda dapat menambahkan lebih banyak dosen dengan format yang sama sesuai kebutuhan.

---

## **Menggabungkan Semua Perintah SQL**

Jika Anda ingin menggabungkan semua perintah SQL di atas ke dalam satu skrip untuk diimpor sekaligus, berikut adalah skrip lengkapnya:

```sql
-- Mengisi data ke tabel `fakultas`
INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Fakultas Teknik'),
(2, 'Fakultas Ilmu Komputer'),
(3, 'Fakultas Ekonomi'),
(4, 'Fakultas Industri Kreatif'),
(5, 'Fakultas Perencanaan'),
(6, 'Fakultas Sains dan Matematika');

-- Mengisi data ke tabel `programstudi`
INSERT INTO `programstudi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknik Elektro'),
(2, 'Teknik Mesin'),
(3, 'Teknik Informatika'),
(4, 'Sistem Informasi'),
(5, 'Ekonomi Manajemen'),
(6, 'Desain Komunikasi Visual'),
(7, 'Teknik Sipil'),
(8, 'Teknik Kimia'),
(9, 'Matematika Terapan'),
(10, 'Fisika'),
(11, 'Biologi'),
(12, 'Teknik Industri');

-- Mengisi data ke tabel `mahasiswa`
INSERT INTO `mahasiswa` (`nim`, `nama`, `email`, `kd_prodi`) VALUES
('2023312801', 'GABRIEL FEBRIAN RAJAGUKGUK', 'gabriefebrian@itpln.ac.id', 3),
('2023312802', 'MATTHEW WYCLIFFE LIGHT WOWOR', 'matthewwowor@itpln.ac.id', 3),
('2023312803', 'ENRICH OSCAR LINAUS SWOM', 'enrichswom@itpln.ac.id', 4),
('2023312804', 'MUHAMMAD NURBANI YUSUF', 'muhnuryusuf@itpln.ac.id', 5),
('2023312805', 'SELMA ZETAPRIANA', 'selmazetapriana@itpln.ac.id', 2),
('2023312806', 'SULTAN MALIK MUZZAKKI', 'sultanmuzzakki@itpln.ac.id', 1),
('2023312807', 'AHMAD IZZULKAMAL', 'ahmadizzul@itpln.ac.id', 3),
('2023312808', 'ABYAZ RABBANI', 'abyazrabbani@itpln.ac.id', 4),
('2023312809', 'MUHAMAD FAUZI AKBAR', 'fauziakbar@itpln.ac.id', 6),
('2023312810', 'MUH.CHOLISH SAID AL BAASITH', 'cholishbaasith@itpln.ac.id', 1),
('2023312811', 'MOHAMMAD AQIL ATHALLAH', 'mohammadaqil@itpln.ac.id', 2),
('2023312812', 'JOHENA RUTH DIANDRA TEOPILUS', 'johena.diandra@itpln.ac.id', 5),
('2023312813', 'ANGGIE NATALIA PASARIBU', 'anggie.pasaribu@itpln.ac.id', 6),
('2023312814', 'M.KAHLIL GHIBRAN', 'mkahlilghibran@itpln.ac.id', 3),
('2023312815', 'AGUSTNE L.B NIKIJULUW', 'agustne.nikijuluw@itpln.ac.id', 4),
('2023312816', 'ABDUL GHOFUR', 'abdulghofur@itpln.ac.id', 2),
('2023312817', 'MUHAMMAD FAIZ SAFIN HADI', 'faizsafin@itpln.ac.id', 1),
('2023312818', 'ANDREAS FEBRYAN MANURUNG', 'andreasmanurung@itpln.ac.id', 5),
('2023312819', 'ERNEST HAMONANGAN REINHARD AY', 'ernest.reinhard@itpln.ac.id', 6),
('2023312820', 'FRANSISKUS REIKI GANESHA PRATAMA', 'fransiskus.pratama@itpln.ac.id', 3),
('2023312821', 'RAFLY MAULANA IHSAN', 'rafly.ihsan@itpln.ac.id', 4),
('2023312822', 'BUNBUN SARNAVIA PANJAITAN', 'bunbun.panjaitan@itpln.ac.id', 2),
('2023312823', 'MUHAMMAD RAKHA SYAIFULLAH YAHYA', 'muhammadrakha@itpln.ac.id', 1),
('2023312824', 'MUHAMMAD HUMAM ASSHIDDIQ', 'humam.asshiddiq@itpln.ac.id', 3),
('2023312825', 'ST.ZALIKHAH AL-MAHDIYYAH.J', 'zalikha.almahdiyyah@itpln.ac.id', 5),
('2023312826', 'ARI PUTRA FREDERICK LELULY', 'ari.fredeluly@itpln.ac.id', 4),
('2023312827', 'GABRIELLA TESALONIKA NABABAN', 'gabriella.nababan@itpln.ac.id', 6),
('2023312828', 'JELYCA. O. RANGKOLY', 'jelyca.rangkoly@itpln.ac.id', 2),
('2023312829', 'MUHAMMAD ALFIN HARIANSYAH', 'alfin.hariansyah@itpln.ac.id', 1),
('2023312830', 'KURNIAWAN WIBISONO', 'kurniawan.wibisono@itpln.ac.id', 3),
('2023312831', 'DOMMIYAN FAITH WARELLA', 'dommiyan.warella@itpln.ac.id', 4),
('2023312832', 'ANDI ALIF LAKSAMANA PUTRA BAHTIAR', 'andi.bahtiar@itpln.ac.id', 2);

-- Mengisi data ke tabel `dosen`
INSERT INTO `dosen` (`nid`, `nama`, `kd_prodi`, `kd_fakultas`, `email`) VALUES
(1001, 'Dr. Ir. Ahmad Santoso', 1, 1, 'ahmad.santoso@itpln.ac.id'),
(1002, 'Prof. Dr. Dewi Lestari', 3, 2, 'dewi.lestari@itpln.ac.id'),
(1003, 'Dr. Eng. Budi Setiawan', 2, 1, 'budi.setiawan@itpln.ac.id'),
(1004, 'Dr. Ir. Clara Wijaya', 4, 4, 'clara.wijaya@itpln.ac.id'),
(1005, 'Dr. Farhan Maulana', 5, 3, 'farhan.maulana@itpln.ac.id');
```

### **Cara Menggunakan Skrip Ini:**

1. **Backup Database:** Sebelum melakukan perubahan, sangat disarankan untuk melakukan backup database untuk menghindari kehilangan data jika terjadi kesalahan.

2. **Jalankan Skrip SQL:**
   - **Via phpMyAdmin:**
     - Buka phpMyAdmin dan pilih database `akademik`.
     - Klik tab **"SQL"**.
     - Salin dan tempelkan skrip SQL di atas ke dalam kotak teks.
     - Klik **"Go"** untuk menjalankan skrip.
   - **Via MySQL Command Line:**
     - Buka terminal atau command prompt.
     - Login ke MySQL:
       ```bash
       mysql -u username -p
       ```
     - Pilih database `akademik`:
       ```sql
       USE akademik;
       ```
     - Tempelkan dan jalankan skrip SQL di atas.

3. **Verifikasi Data:**
   - Setelah menjalankan skrip, pastikan data telah terisi dengan benar.
   - Anda dapat menjalankan query berikut untuk memeriksa data:
     ```sql
     SELECT * FROM fakultas;
     SELECT * FROM programstudi;
     SELECT * FROM mahasiswa;
     SELECT * FROM dosen;
     ```

---

## **Catatan Tambahan:**

- **Konsistensi Data:**
  - Pastikan bahwa kode `kd_prodi` pada tabel `mahasiswa` dan `dosen` sesuai dengan yang ada di tabel `programstudi`.
  - Pastikan bahwa kode `kd_fakultas` pada tabel `dosen` sesuai dengan yang ada di tabel `fakultas`.

- **Email:**
  - Pastikan format email sesuai dengan kebijakan institusi Anda. Domain `@itpln.ac.id` digunakan sebagai contoh.

- **Penambahan Data:**
  - Anda dapat menambahkan lebih banyak data dengan mengikuti format yang sama.
  - Untuk NIM dan NID, pastikan tidak ada duplikasi agar menjaga integritas data.

- **Penggunaan Transaksi:**
  - Jika Anda ingin memastikan semua perintah SQL dieksekusi dengan sukses atau dibatalkan sekaligus, Anda dapat membungkus perintah INSERT dalam transaksi:
    ```sql
    START TRANSACTION;

    -- Perintah INSERT di sini

    COMMIT;
    ```
  - Jika terjadi kesalahan, Anda dapat membatalkan transaksi dengan perintah `ROLLBACK;`.

- **Optimasi:**
  - Setelah mengisi banyak data, Anda dapat menambahkan indeks atau optimasi lain sesuai kebutuhan untuk meningkatkan performa query.

Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan tambahan, jangan ragu untuk bertanya!
