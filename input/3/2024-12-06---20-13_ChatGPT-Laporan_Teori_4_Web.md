# Laporan Teori 4 Web

#### You:
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Teori 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
        }
        
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            position: fixed;
            transition: all 0.3s;
        }

        .nav-link {
            color: rgba(255,255,255,.8);
            margin: 5px 0;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: white;
            color: var(--primary-color);
        }

        .content {
            margin-left: 25%;
            padding: 20px;
            transition: all 0.3s;
        }

        .question-card {
            display: none;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            background: white;
            box-shadow: 0 2px 15px rgba(0,0,0,.1);
            padding: 15px 0;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="bi bi-journal-text"></i>
                Laporan Teori
            </span>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        Ari Putra Frederick Leluly
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 60px">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-book display-4"></i>
                    <h4>Navigation Menu</h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="#" data-question="1">
                        <i class="bi bi-1-circle"></i> Soal Pertama
                    </a>
                    <a class="nav-link" href="#" data-question="2">
                        <i class="bi bi-2-circle"></i> Soal Kedua
                    </a>
                    <a class="nav-link" href="#" data-question="3">
                        <i class="bi bi-3-circle"></i> Soal Ketiga
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">
                <div class="header text-center">
                    <h1 class="display-4">LAPORAN TEORI 4</h1>
                    <p class="lead">Ari Putra Frederick Leluly | 202331280</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </nav>
                </div>

                <div id="question1" class="question-card">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Soal 1</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Pertanyaan pertama
                            </div>
                            <p>Jawaban soal 1 di sini...</p>
                        </div>
                    </div>
                </div>

                <div id="question2" class="question-card">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h3 class="mb-0">Soal 2</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Pertanyaan kedua
                            </div>
                            <p>Jawaban soal 2 di sini...</p>
                        </div>
                    </div>
                </div>

                <div id="question3" class="question-card">
                    <div class="card shadow-sm">
                        <div class="card-header bg-warning">
                            <h3 class="mb-0">Soal 3</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Pertanyaan ketiga
                            </div>
                            <p>Jawaban soal 3 di sini...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.question-card').forEach(content => {
                content.style.display = 'none';
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    document.querySelectorAll('.question-card').forEach(content => {
                        content.style.display = 'none';
                    });

                    const questionId = this.getAttribute('data-question');
                    document.getElementById('question' + questionId).style.display = 'block';

                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>

----

Mata kuliah : Pemograman web
sudah belajar tentang html, css, javascript, php dan bootstrap

tolong kerjakaan laporan saya:
Hasil pengerjaan laporan praktikum akan berupa penjelasan
Hasil screenshot coding dan running file wajib diberikan watermark. Jelaskan juga 
Langkah-langkah pengerjaan coding. 
Soal : 
A. Buatlah suatu halaman web yang berisi Judul serta Sub Judul (h1 dan h2), 
yaitu:  
a. Judul: LAPORAN TEORI  
b. Sub Judul: Nama | NIM  
Dengan web yang berisi soal-soal Teori dengan fitur sidebar. Sidebar tersebut 
akan menampilkan daftar soal, dan ketika salah satu soal diklik, jawabannya 
akan ditampilkan di halaman tanpa menghilangkan tampilan sidebar. Gunakan 
Bootstrap dan JavaScript untuk mempercantik tampilan dan meningkatkan 
interaktivitas website.


saya sudah kerjakan, tolong buat laporanya, 
tolong berikan langkah langkahnya dan penjelsanya, untuk saya ss dan beri penjelasan pada laporan di word saya

#### ChatGPT:
### Laporan Praktikum: Pemrograman Web

#### Judul: **LAPORAN TEORI 4**

#### Sub Judul: **Ari Putra Frederick Leluly | 202331280**

### 1. **Deskripsi Pengerjaan**

Pada praktikum ini, saya telah membuat sebuah halaman web yang menampilkan sebuah laporan dengan beberapa soal teori, menggunakan HTML, CSS, JavaScript, dan Bootstrap. Halaman web ini dilengkapi dengan sidebar untuk navigasi soal, di mana setiap soal dapat diklik dan jawabannya akan ditampilkan di halaman utama tanpa menghilangkan tampilan sidebar.

### 2. **Langkah-Langkah Pengerjaan**

#### a. **Membuat Struktur Halaman Web (HTML)**

1. **Membuat kerangka dasar HTML**:
   - Halaman ini dimulai dengan mendeklarasikan dokumen HTML dengan elemen `<html>`, menetapkan bahasa sebagai `en` (English) pada elemen `<html lang="en">`.
   - Menambahkan elemen `<head>` yang berisi informasi penting seperti charset, viewport, dan judul halaman.
   ```html
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Laporan Teori</title>
   </head>
   ```

2. **Menambahkan Navigasi dan Sidebar**:

   - Menggunakan Bootstrap untuk membuat tampilan navbar dan sidebar.
   - Navbar menampilkan nama dan NIM saya, serta opsi dropdown untuk profil.
   - Sidebar terdiri dari daftar soal yang dapat diklik untuk menampilkan jawaban soal yang relevan.

   ```html
   <div class="sidebar">
       <nav class="nav flex-column">
           <a class="nav-link" href="#" data-question="1">Soal Pertama</a>
           <a class="nav-link" href="#" data-question="2">Soal Kedua</a>
           <a class="nav-link" href="#" data-question="3">Soal Ketiga</a>
       </nav>
   </div>
   ```

#### b. **Desain Tampilan (CSS)**

1. **Membuat tema warna**:
   - Menggunakan variabel CSS (`:root`) untuk mendefinisikan warna utama dan sekunder.
   ```css
   :root {
       --primary-color: #4e73df;
       --secondary-color: #858796;
   }
   ```

2. **Mendesain Sidebar dan Navigasi**:
   - Sidebar diatur menggunakan properti `position: fixed` untuk membuatnya tetap berada di sisi kiri halaman.
   - Menambahkan efek hover pada elemen sidebar agar interaktif saat diklik.
   ```css
   .sidebar {
       height: 100vh;
       background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
       color: white;
       position: fixed;
       transition: all 0.3s;
   }

   .nav-link:hover {
       background: rgba(255,255,255,.1);
       color: white;
       transform: translateX(5px);
   }
   ```

#### c. **Menambahkan Interaktivitas (JavaScript)**

1. **Membuat Fitur Navigasi untuk Menampilkan Jawaban**:

   - Menggunakan JavaScript untuk menangani event klik pada link soal di sidebar.
   - Ketika soal diklik, jawaban soal akan ditampilkan dengan menambahkan class `.active` pada link yang diklik, dan menyembunyikan jawaban soal lain.

   ```javascript
   document.addEventListener('DOMContentLoaded', function() {
       document.querySelectorAll('.question-card').forEach(content => {
           content.style.display = 'none';
       });

       document.querySelectorAll('.nav-link').forEach(link => {
           link.addEventListener('click', function(e) {
               e.preventDefault();
               document.querySelectorAll('.question-card').forEach(content => {
                   content.style.display = 'none';
               });
               const questionId = this.getAttribute('data-question');
               document.getElementById('question' + questionId).style.display = 'block';
               document.querySelectorAll('.nav-link').forEach(link => {
                   link.classList.remove('active');
               });
               this.classList.add('active');
           });
       });
   });
   ```

2. **Animasi Fade In untuk Jawaban**:
   - Saya juga menambahkan animasi menggunakan CSS untuk membuat jawaban soal tampil dengan efek fade-in.
   ```css
   .question-card {
       display: none;
       animation: fadeIn 0.5s;
   }

   @keyframes fadeIn {
       from { opacity: 0; transform: translateY(20px); }
       to { opacity: 1; transform: translateY(0); }
   }
   ```

### 3. **Tampilan Hasil**

- **Sidebar**: Menampilkan tiga soal, dan setiap soal bisa diklik untuk menampilkan jawabannya di area konten utama.
- **Konten Halaman**: Tampilkan judul dan subjudul menggunakan elemen `<h1>` dan `<h2>`, serta menampilkan jawaban dari setiap soal ketika soal diklik.
- **Responsive Design**: Menggunakan Bootstrap untuk memastikan tampilan halaman responsif pada berbagai ukuran layar.

### 4. **Screenshot dan Penjelasan**

Untuk keperluan laporan, lakukan screenshot pada halaman hasil yang sudah selesai dengan watermark untuk menandakan bahwa itu adalah hasil kerja Anda. Setiap screenshot sebaiknya dilengkapi dengan penjelasan tentang apa yang ditampilkan pada bagian tersebut.

Contoh screenshot yang diambil bisa menunjukkan tampilan sidebar dengan jawaban soal yang sedang aktif, serta kode yang diterapkan di bagian tersebut.

### 5. **Kesimpulan**

Pada praktikum ini, saya berhasil membuat halaman web interaktif menggunakan HTML, CSS, JavaScript, dan Bootstrap. Fitur sidebar yang dapat mengubah tampilan jawaban soal secara dinamis tanpa menghilangkan sidebar adalah implementasi dari konsep interaktivitas yang dipelajari dalam perkuliahan. Dengan menggunakan Bootstrap, tampilan halaman menjadi responsif dan menarik.

---

**Catatan**: Jangan lupa untuk menambahkan screenshot hasil pengerjaan dengan watermark, dan lampirkan di laporan Word Anda.


#### You:
jelaskan yang ini

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="bi bi-journal-text"></i>
                Laporan Teori
            </span>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        Ari Putra Frederick Leluly
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

#### ChatGPT:
Kode yang Anda berikan adalah bagian dari elemen **navbar** (navigasi bar) yang sering digunakan dalam desain web responsif dengan menggunakan framework **Bootstrap**. Berikut penjelasan setiap bagian dari kode tersebut:

### 1. **Elemen `<nav>`**

```html
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
```

- **`<nav>`**: Ini adalah elemen HTML yang digunakan untuk mendefinisikan area navigasi pada halaman web.
- **`navbar`**: Kelas Bootstrap yang digunakan untuk membuat navigasi bar yang responsif dan dapat disesuaikan.
- **`navbar-expand-lg`**: Membuat navbar bisa melebar pada layar besar dan mengecil pada layar lebih kecil (responsive). `lg` berarti navbar akan melebar pada layar dengan ukuran "large" dan lebih besar.
- **`navbar-light`**: Menetapkan navbar dengan tema warna terang (cocok dengan latar belakang terang, seperti putih).
- **`bg-white`**: Menetapkan warna latar belakang navbar menjadi putih.
- **`fixed-top`**: Menetapkan navbar untuk tetap berada di bagian atas halaman, bahkan saat halaman di-scroll.
- **`shadow-sm`**: Memberikan efek bayangan ringan (small shadow) di bawah navbar untuk tampilan lebih elegan.

### 2. **Elemen `<div class="container-fluid">`**

```html
<div class="container-fluid">
```

- **`container-fluid`**: Kelas Bootstrap yang digunakan untuk membuat container yang mengambil lebar penuh dari layar. Ini memungkinkan navbar dan konten di dalamnya untuk meluas secara horizontal sesuai ukuran layar.

### 3. **Elemen `<span class="navbar-brand">`**

```html
<span class="navbar-brand">
    <i class="bi bi-journal-text"></i>
    Laporan Teori
</span>
```

- **`navbar-brand`**: Kelas ini digunakan untuk menandai brand atau judul dari situs atau aplikasi yang biasanya ada di kiri navbar.
- **`<i class="bi bi-journal-text"></i>`**: Ini adalah elemen ikon dari **Bootstrap Icons** (ikon pustaka dari Bootstrap). `bi-journal-text` adalah ikon buku, yang biasanya digunakan untuk mewakili tulisan atau laporan.
- **`Laporan Teori`**: Ini adalah teks yang ditampilkan di sebelah kiri navbar sebagai nama atau judul halaman web.

### 4. **Elemen Dropdown (Profil Pengguna)**

```html
<div class="d-flex">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
            Ari Putra Frederick Leluly
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
        </ul>
    </div>
</div>
```

- **`d-flex`**: Kelas Flexbox dari Bootstrap yang membuat elemen di dalamnya (seperti dropdown) diatur dalam baris (horizontal).
- **`dropdown`**: Kelas Bootstrap yang digunakan untuk membuat menu dropdown, yang akan muncul ketika tombol ditekan.
- **`btn btn-light dropdown-toggle`**: Tombol yang diberi kelas `btn-light` (tombol dengan latar belakang terang) dan `dropdown-toggle` (untuk membuat tombol dapat membuka dropdown saat diklik).
- **`data-bs-toggle="dropdown"`**: Atribut ini memberitahu Bootstrap untuk membuka menu dropdown saat tombol diklik.
- **`<i class="bi bi-person-circle"></i>`**: Ikon pengguna (person circle) yang menandakan profil pengguna.
- **`Ari Putra Frederick Leluly`**: Nama pengguna yang ditampilkan di tombol dropdown.
- **`<ul class="dropdown-menu">`**: Daftar menu dropdown yang muncul setelah tombol diklik.
  - **`<li><a class="dropdown-item" href="#">Profile</a></li>`**: Item pertama dari dropdown, yaitu menu "Profile".
  - **`<li><a class="dropdown-item" href="#">Settings</a></li>`**: Item kedua dari dropdown, yaitu menu "Settings".

### Kesimpulan

Navbar ini berfungsi sebagai elemen navigasi di bagian atas halaman. Dengan fitur **fixed-top**, navbar tetap terlihat meskipun halaman di-scroll. Di dalamnya terdapat nama halaman **Laporan Teori** yang dilengkapi dengan ikon dan tombol dropdown untuk pengaturan profil pengguna (termasuk opsi untuk melihat profil dan pengaturan). Desain ini membuat navbar tidak hanya terlihat rapi dan profesional, tetapi juga menyediakan fungsionalitas untuk menampilkan menu pengaturan pengguna.


#### You:
jangan pakai point saya hanya ingin paragraf, 

#### ChatGPT:
Kode yang Anda berikan adalah bagian dari elemen navbar yang dibuat menggunakan framework Bootstrap untuk halaman web. Elemen `<nav>` dengan kelas `navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm` digunakan untuk membuat navbar responsif yang selalu berada di bagian atas halaman meskipun pengguna menggulir halaman ke bawah. Navbar ini memiliki latar belakang putih dan bayangan halus di bawahnya untuk memberikan tampilan yang lebih elegan. Di dalam navbar, terdapat elemen `<span class="navbar-brand">` yang berfungsi menampilkan nama halaman atau aplikasi, yang dalam hal ini adalah "Laporan Teori", lengkap dengan ikon dari Bootstrap Icons yang mewakili teks tersebut.

Selain itu, terdapat juga elemen dropdown yang diletakkan di sisi kanan navbar dengan kelas `d-flex` untuk memastikan elemen-elemen di dalamnya sejajar secara horizontal. Tombol dropdown tersebut berisi nama pengguna "Ari Putra Frederick Leluly", yang diikuti oleh ikon pengguna, menandakan ini adalah menu profil pengguna. Ketika tombol ini diklik, sebuah menu dropdown akan muncul, yang berisi dua pilihan: "Profile" dan "Settings". Menu ini memungkinkan pengguna untuk mengakses pengaturan profil atau mengubah preferensinya. Dengan desain seperti ini, navbar tidak hanya berfungsi untuk navigasi, tetapi juga meningkatkan interaktivitas dan kenyamanan pengguna dalam mengakses informasi dan pengaturan pribadi mereka.


#### You:
sekarang

  <div id="pertanyaan1" class="question-card">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Soal 1</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Pertanyaan pertama
                            </div>
                            <p>Jawaban soal 1 di sini...</p>
                        </div>
                    </div>
                </div>

#### ChatGPT:
Bagian kode ini berfungsi untuk menampilkan satu set elemen yang berisi soal dan jawabannya di dalam halaman. Elemen ini dibungkus dengan `div` yang memiliki ID `pertanyaan1` dan kelas `question-card`, yang memungkinkan elemen ini dikelola secara terpisah, misalnya untuk manipulasi dengan JavaScript atau penampilan dinamis. Di dalamnya, terdapat elemen `<div class="card shadow-sm">` yang merupakan bagian dari komponen kartu Bootstrap, dengan bayangan halus (`shadow-sm`) untuk memberikan efek kedalaman dan tampilan yang lebih menarik.

Pada bagian atas kartu, terdapat elemen `card-header` dengan kelas `bg-primary` yang memberikan latar belakang biru dan `text-white` yang membuat teks di dalamnya berwarna putih. Di dalam `card-header`, ada elemen `<h3>` yang berfungsi sebagai judul soal, dalam hal ini "Soal 1". Bagian isi kartu terdapat di dalam `card-body`, yang berisi dua elemen utama: pertama, sebuah alert dengan kelas `alert alert-info` untuk memberikan informasi kepada pengguna, diikuti dengan ikon informasi dari Bootstrap Icons (`bi bi-info-circle`), dan kedua, paragraf `<p>` yang berisi jawaban dari soal pertama. Dengan menggunakan struktur ini, konten soal dan jawaban disajikan secara terstruktur dan mudah diakses.


#### You:
sekarang 

 <div class="header text-center">
                    <h1 class="display-4">LAPORAN TEORI 4</h1>
                    <p class="lead">Ari Putra Frederick Leluly | 202331280</p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </nav>
                </div>

#### ChatGPT:
Bagian kode ini digunakan untuk menampilkan header di halaman web, yang berfungsi memberikan judul dan informasi terkait dengan konten yang ada. Pada elemen pertama, terdapat `div` dengan kelas `header text-center` yang membuat seluruh konten di dalamnya diratakan ke tengah. Di dalamnya, terdapat elemen `<h1 class="display-4">` yang digunakan untuk menampilkan judul besar "LAPORAN TEORI 4", dengan kelas `display-4` yang memberikan ukuran font besar dan jelas. Di bawahnya, ada elemen `<p class="lead">`, yang berfungsi untuk menampilkan subjudul atau informasi tambahan, dalam hal ini nama dan NIM "Ari Putra Frederick Leluly | 202331280", dengan gaya teks yang lebih ringan dan lebih kecil dibandingkan judul utama.

Selanjutnya, terdapat elemen `nav` dengan atribut `aria-label="breadcrumb"` yang digunakan untuk menampilkan breadcrumb, sebuah navigasi yang memberi petunjuk tentang lokasi pengguna dalam struktur halaman. Breadcrumb tersebut dibungkus dalam elemen `<ol class="breadcrumb justify-content-center">`, yang menampilkan daftar navigasi dengan item "Home" yang mengarah ke halaman utama dan item "Laporan" yang menunjukkan bahwa pengguna sedang berada di bagian laporan. Dengan menggunakan breadcrumb, pengguna bisa mengetahui posisinya di dalam aplikasi dan mudah untuk kembali ke halaman sebelumnya jika diperlukan.


#### You:
sekarang 

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.question-card').forEach(content => {
        content.style.display = 'none';
    });

    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.question-card').forEach(content => {
                content.style.display = 'none';
            });

            const questionId = this.getAttribute('data-question');
            document.getElementById('question' + questionId).style.display = 'block';

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});

#### ChatGPT:
Bagian kode JavaScript ini berfungsi untuk mengelola interaktivitas dan tampilan konten soal pada halaman web. Fungsi utama dari kode ini adalah menyembunyikan dan menampilkan soal-soal sesuai dengan pilihan pengguna di sidebar.

Pertama, kode menggunakan event listener `DOMContentLoaded` untuk memastikan bahwa seluruh konten halaman telah dimuat sepenuhnya sebelum menjalankan skrip ini. Setelah itu, kode memilih semua elemen dengan kelas `.question-card` (yang mewakili konten soal) dan mengatur properti `display` mereka menjadi 'none', sehingga semua soal tersembunyi pada awalnya.

Kemudian, kode melanjutkan dengan memilih semua elemen `.nav-link` (tautan soal di sidebar) dan menambahkan event listener pada setiap elemen tersebut. Ketika salah satu tautan diklik, event listener akan mencegah aksi default dari tautan (menggunakan `e.preventDefault()`), yang biasanya akan memuat ulang halaman. Selanjutnya, kode ini menyembunyikan semua soal lagi dengan mengatur `display` mereka menjadi 'none'.

Setelah itu, kode mengambil nilai atribut `data-question` dari tautan yang diklik, yang menyimpan ID soal terkait (misalnya, "1", "2", atau "3"). Menggunakan nilai ini, kode menampilkan soal yang sesuai dengan mengubah properti `display` soal yang memiliki ID yang cocok (misalnya, `question1`, `question2`, atau `question3`) menjadi 'block', sehingga soal yang dipilih akan muncul.

Selain itu, kode juga memastikan hanya satu tautan yang memiliki kelas 'active' pada saat yang sama. Setelah soal baru ditampilkan, kelas 'active' dihapus dari semua tautan dan ditambahkan ke tautan yang baru saja diklik, memberikan efek visual pada sidebar yang menunjukkan soal yang sedang aktif. Ini membuat pengalaman pengguna lebih interaktif dan dinamis.


#### You:
jelaskan dengan singkat

#### ChatGPT:
Kode ini mengelola tampilan soal di halaman. Ketika halaman dimuat, semua soal disembunyikan. Ketika salah satu tautan soal di sidebar diklik, kode akan menyembunyikan semua soal, lalu menampilkan soal yang sesuai dengan mengubah gaya tampilan (`display`). Selain itu, kode juga memastikan hanya satu tautan yang memiliki kelas 'active', memberikan efek visual untuk menunjukkan soal yang sedang aktif. Dengan cara ini, pengguna bisa beralih antara soal tanpa halaman di-refresh.
