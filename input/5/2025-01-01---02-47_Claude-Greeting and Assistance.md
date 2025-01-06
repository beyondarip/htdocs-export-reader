## Prompt:
hi

## Response:
Hi! How can I help you today?

## Prompt:
local HISTFILE = "/home/metfoil/.local/share/ezel/data/log/mpv.txt"; mp.register\_event('file-loaded', function() local logfile; title = mp.get\_property('media-title'); title = (title == mp.get\_property('filename') and '' or ('(%s)'):format(title)); local sourcePath = mp.get\_property\_native("path") logfile = io.open(HISTFILE, 'a+'); logfile:write(('\[%s\]: %s :%s\\n'):format(os.date('%Y-%m-%d---%H-%M'), sourcePath,title)); logfile:close(); end) ini scrpt lua untuk mpv , tolong buat ulang dengan best practice bisa untuk linux dan windows, log nya di directory mpv config saja research terlebih dahulu, implmentasi dengan best practice

## Response:
I'll help you create a more robust MPV Lua script for logging played media that works across both Linux and Windows, following best practices.

MPV History Logger Script

Click to open code

Saya telah membuat script yang lebih baik dengan beberapa peningkatan:

1.  **Cross-Platform Support**:
    *   Otomatis mendeteksi OS dan menggunakan path yang sesuai
    *   Bekerja di Windows, Linux, dan MacOS
2.  **Best Practices**:
    *   Menggunakan modul MPV resmi (utils, msg, options)
    *   Error handling yang lebih baik
    *   Logging untuk debugging
    *   Konfigurasi yang dapat disesuaikan
3.  **Fitur Tambahan**:
    *   Format tanggal yang dapat dikonfigurasi
    *   Pembuatan direktori otomatis jika belum ada
    *   Dokumentasi lengkap

Cara Penggunaan:

1.  Simpan script sebagai:
    *   Linux/MacOS: `~/.config/mpv/scripts/history-logger.lua`
    *   Windows: `%APPDATA%/mpv/scripts/history-logger.lua`
2.  (Opsional) Untuk kustomisasi, buat file konfigurasi:
    *   Linux/MacOS: `~/.config/mpv/script-opts/history_logger.conf`
    *   Windows: `%APPDATA%/mpv/script-opts/history_logger.conf`

Contoh isi file konfigurasi:

```
date_format=%Y-%m-%d %H:%M:%S
log_file_name=my-playback-history.log
max_entries=2000
```

Log akan disimpan di direktori config MPV dengan nama default `playback-history.log`.

Apakah ada bagian yang ingin Anda sesuaikan atau pertanyaan tentang penggunaannya?

## Prompt:
jangan buat file .conf nya, langsung saja di lua nya

## Response:
Baik, saya akan menyederhanakan scriptnya dengan menghilangkan opsi konfigurasi eksternal.

MPV History Logger Script

Click to open code

Saya telah menyederhanakan script dengan beberapa perubahan:

1.  Menghapus dependensi `options` module dan file konfigurasi eksternal
2.  Menyederhanakan konfigurasi menjadi table `CONFIG` yang bisa langsung diedit di file lua
3.  Menyederhanakan error handling
4.  Tetap mempertahankan fungsi cross-platform

Cara Penggunaan:

1.  Simpan script sebagai:
    *   Linux/MacOS: `~/.config/mpv/scripts/history-logger.lua`
    *   Windows: `%APPDATA%/mpv/scripts/history-logger.lua`
2.  Untuk mengubah konfigurasi, cukup edit nilai dalam table `CONFIG` di bagian atas script:
    *   `date_format`: Format tanggal dan waktu
    *   `log_file_name`: Nama file log

Log akan otomatis tersimpan di folder config MPV Anda. Format log tetap sama seperti sebelumnya:

```
[2024-12-31 15:30:45] /path/to/video.mp4 (Judul Video)
```

Apakah ada yang ingin dimodifikasi lagi?

## Prompt:
tolong analisis script lua itu, ini script mpv ,

dan buatkan 1 file script yang light weight tapi powerfull

dimana jika saya pencet mp.add\_key\_binding('Shift+RIGHT', 'nextfile', nexthandler) mp.add\_key\_binding('Shift+LEFT', 'previousfile', prevhandler)

di dalam semua script itu ada script / button untuk next file juga , tolong bantu saya

analisis dan implmentasi dengan best practice

## Response:
Setelah menganalisis script-script tersebut, saya akan membuat versi yang ringan (lightweight) namun tetap powerful untuk navigasi file. Script ini akan menggunakan beberapa konsep bagus dari script-script tersebut namun dalam versi yang lebih sederhana.

MPV File Navigator

Click to open code

Saya telah membuat script yang lebih ringan namun tetap powerful dengan beberapa keunggulan:

1.  **Ringan & Efisien**:
    *   Kode lebih sederhana tapi tetap fungsional
    *   Tidak ada dependensi kompleks
    *   Menggunakan memori lebih sedikit
2.  **Fitur Utama**:
    *   Navigasi file maju/mundur
    *   Dukungan berbagai format video dan audio
    *   Mengingat posisi terakhir pemutaran
    *   Pesan OSD saat navigasi
    *   Penanganan path cross-platform
3.  **Keunggulan**:
    *   Penanganan error yang lebih baik
    *   Normalisasi path untuk Windows/Linux
    *   Sortir file secara alfabetis
    *   Loop playlist otomatis
    *   Konfigurasi mudah di bagian atas script

Cara Penggunaan:

1.  Simpan sebagai `~/.config/mpv/scripts/navigator.lua` (Linux) atau `%APPDATA%/mpv/scripts/navigator.lua` (Windows)
2.  Gunakan:
    *   `Shift+RIGHT`: File berikutnya
    *   `Shift+LEFT`: File sebelumnya

Untuk mengkustomisasi, Anda bisa mengubah pengaturan di bagian `config` di awal script.

Apakah ada bagian yang ingin disesuaikan atau pertanyaan tentang cara kerjanya?

