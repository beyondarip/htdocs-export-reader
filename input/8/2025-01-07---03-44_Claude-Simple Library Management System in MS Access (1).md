## Prompt:
Butuh panduan pembuatan sistem perpustakaan sederhana Menggunakan Microsoft Access untuk tugas basis data dengan spesifikasi: Fitur utama: - Peminjaman buku - Pengembalian buku - Data anggota umum - Data buku Timeline: 1 hari pengerjaan FITUR WAJIB: - Input/edit data buku - Input/edit data anggota - Peminjaman buku - Pengembalian buku KEBUTUHAN: 1. ERD dan relasi antar tabel 2. Struktur tabel dengan field-field dasar 3. Form untuk: - Input data buku - Input data anggota - Transaksi peminjaman/pengembalian 4. Report sederhana 5. Query untuk menampilkan data penting Mohon sertakan tutorial step-by-step termasuk lokasi tools di MS Access karena saya pemula Mohon fokus pada implementasi dasar yang sesuai level mahasiswa. Tidak perlu fitur kompleks.

buat step by step akan ada banyak part , sekarang part 1 dulu lanjutkan saat saya prompt lanjutkan

## Response:
Part 1: Perancangan Database Perpustakaan

1.  ERD dan Relasi Tabel:

```
Anggota (1:N) Peminjaman (N:1) Buku
```

2.  Struktur Tabel Dasar:

Tabel Anggota:

*   ID\_Anggota (Primary Key)
*   Nama
*   Alamat
*   No\_Telp
*   Email

Tabel Buku:

*   ID\_Buku (Primary Key)
*   Judul
*   Pengarang
*   Penerbit
*   Tahun\_Terbit
*   Stok

Tabel Peminjaman:

*   ID\_Peminjaman (Primary Key)
*   ID\_Anggota (Foreign Key)
*   ID\_Buku (Foreign Key)
*   Tanggal\_Pinjam
*   Tanggal\_Kembali
*   Status

Langkah Implementasi di MS Access:

1.  Buka MS Access, pilih "Blank database"
2.  Buat tabel Anggota:

*   Klik "Create" tab -> "Table"
*   Design View -> Save sebagai "Anggota"
*   Buat field sesuai struktur di atas
*   Set ID\_Anggota sebagai Primary Key (klik kanan -> Primary Key)
*   Save

3.  Buat tabel Buku:

*   Ulangi langkah seperti tabel Anggota
*   Buat field sesuai struktur
*   Set ID\_Buku sebagai Primary Key
*   Save sebagai "Buku"

4.  Buat tabel Peminjaman:

*   Ulangi langkah pembuatan tabel
*   Buat field sesuai struktur
*   Set ID\_Peminjaman sebagai Primary Key
*   Save sebagai "Peminjaman"

5.  Buat Relationship:

*   Database Tools tab -> Relationships
*   Add semua tabel
*   Drag ID\_Anggota dari tabel Anggota ke ID\_Anggota di tabel Peminjaman
*   Drag ID\_Buku dari tabel Buku ke ID\_Buku di tabel Peminjaman
*   Centang "Enforce Referential Integrity"
*   Save

Lanjutkan untuk instruksi pembuatan form dan query?

## Prompt:
buatkan query create table dan insert nya nya yang compatible di ms access

## Response:
```sql
/* Tabel Anggota */
CREATE TABLE Anggota (
   ID_Anggota AUTOINCREMENT PRIMARY KEY,
   Nama TEXT(50),
   Alamat TEXT(100),
   No_Telp TEXT(15),
   Email TEXT(50)
);

/* Tabel Buku */
CREATE TABLE Buku (
   ID_Buku AUTOINCREMENT PRIMARY KEY,
   Judul TEXT(100),
   Pengarang TEXT(50),
   Penerbit TEXT(50),
   Tahun_Terbit NUMBER,
   Stok NUMBER DEFAULT 0
);

/* Tabel Peminjaman */
CREATE TABLE Peminjaman (
   ID_Peminjaman AUTOINCREMENT PRIMARY KEY,
   ID_Anggota NUMBER,
   ID_Buku NUMBER,
   Tanggal_Pinjam DATE,
   Tanggal_Kembali DATE,
   Status TEXT(20),
   FOREIGN KEY (ID_Anggota) REFERENCES Anggota(ID_Anggota),
   FOREIGN KEY (ID_Buku) REFERENCES Buku(ID_Buku)
);

/* Data Sample Anggota */
INSERT INTO Anggota (Nama, Alamat, No_Telp, Email) VALUES
('John Doe', 'Jl. Merdeka 123', '08123456789', 'john@email.com'),
('Jane Smith', 'Jl. Sudirman 45', '08987654321', 'jane@email.com');

/* Data Sample Buku */
INSERT INTO Buku (Judul, Pengarang, Penerbit, Tahun_Terbit, Stok) VALUES
('Database Design', 'Mike Ross', 'TechPress', 2020, 5),
('Web Programming', 'Sarah Johnson', 'CodeBooks', 2021, 3);

/* Data Sample Peminjaman */
INSERT INTO Peminjaman (ID_Anggota, ID_Buku, Tanggal_Pinjam, Tanggal_Kembali, Status) VALUES
(1, 1, #2024/01/01#, #2024/01/08#, 'Dipinjam'),
(2, 2, #2024/01/02#, #2024/01/09#, 'Dipinjam');
```

Notes:

*   Gunakan '#' untuk format tanggal di MS Access
*   AUTOINCREMENT untuk auto-numbering
*   Tipe data TEXT untuk string
*   NUMBER untuk angka

