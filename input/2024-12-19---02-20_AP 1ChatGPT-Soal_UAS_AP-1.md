# Soal UAS AP-1

#### You:
[Unsupported Content]

#### You:
saya adalah asisten ap-1, sedang membuat soal UAS ap1, 

saya disuruh membuat 2 soal
saya mau yang seperti ini, yang nanti ada screenshot dari saya untuk contoh programnya,
ini jawaban soalnya, buat kan kata katanya

soal 1.
 for (int i = 1; i <= n; ++i) {
        for (int j = 1; j <= n; ++j) {
            int result;
            if (i % 2 == 0) {
                // Even rows: descending
                result = i * (n - j + 1);
            } else {
                // Odd rows: ascending
                result = i * j;
            }
            cout << setw(3) << result << " ";
        }
        cout << endl;
    }

soal 2. 

#include <iostream>
#include <iomanip>
using namespace std;

void printNumberDiamond(int n) {
    // Upper half
    int num = 1;
    for(int i = 1; i <= n; i++) {
        // Spaces
        for(int j = 1; j <= n-i; j++) {
            cout << "   ";
        }
        // Left numbers
        for(int j = 1; j <= i; j++) {
            cout << setw(3) << num++;
        }
        // Right numbers
        for(int j = 1; j < i; j++) {
            cout << setw(3) << --num;
        }
        cout << endl;
        num = 1; // Reset for next row
    }
    
    // Lower half
    for(int i = n-1; i >= 1; i--) {
        // Spaces
        for(int j = 1; j <= n-i; j++) {
            cout << "   ";
        }
        // Left numbers
        for(int j = 1; j <= i; j++) {
            cout << setw(3) << num++;
        }
        // Right numbers
        for(int j = 1; j < i; j++) {
            cout << setw(3) << --num;
        }
        cout << endl;
        num = 1; // Reset for next row
    }
}

int main() {
    int n;
    cout << "Masukan Angka Baris (3-9): ";
    cin >> n;
   
    
    if(n >= 3 && n <= 9) {
    
        printNumberDiamond(n);
    } else {
        cout << "Invalid size! Must be between 3-9.\n";
    }
    return 0;
}




#### ChatGPT:
### Soal 1:

Tulis sebuah program menggunakan **nested loop** di bahasa C++ yang mencetak pola bilangan berdasarkan ketentuan berikut:

1. Pola memiliki bentuk tabel dengan ukuran `n x n`.
2. Untuk baris bernomor **ganjil**, angka-angka pada baris tersebut dihasilkan secara **ascending** (menaik) dengan nilai dihitung sebagai hasil kali nomor baris dengan nomor kolom.
3. Untuk baris bernomor **genap**, angka-angka pada baris tersebut dihasilkan secara **descending** (menurun) dengan nilai dihitung sebagai hasil kali nomor baris dengan nomor kolom, dimulai dari kolom terakhir.

Output program harus sesuai dengan contoh berikut (akan disertakan tangkapan layar hasil eksekusi program).

---

### Soal 2:

Tulis sebuah program di C++ yang mencetak **pola diamond angka** sesuai ketentuan berikut:

1. Pola berbentuk **diamond** (belah ketupat) yang terdiri dari angka.
2. Program meminta input berupa angka `n` (antara 3 hingga 9) yang menentukan jumlah baris pada setengah bagian atas pola.
3. Bagian atas pola mencetak angka yang dimulai dari 1 secara **incremental** dari kiri ke kanan, lalu kembali menurun ke kiri.
4. Bagian bawah pola mencetak angka yang melanjutkan konsep bagian atas, tetapi urutannya menurun hingga pola membentuk belah ketupat sempurna.
5. Jika input `n` berada di luar rentang 3-9, program akan mencetak pesan error dan meminta input ulang.

Output program harus sesuai dengan contoh berikut (akan disertakan tangkapan layar hasil eksekusi program).


#### You:
1 pargraf saja

#### ChatGPT:
### Soal 1:

Buatlah program dalam C++ yang mencetak pola tabel bilangan berukuran `n x n`, di mana angka pada baris ganjil diurutkan secara **menaik** (ascending) dan pada baris genap secara **menurun** (descending), dengan nilai setiap elemen dihitung sebagai hasil kali nomor baris dan nomor kolom.

### Soal 2:

Buatlah program C++ yang mencetak pola **diamond angka** berdasarkan input `n` (antara 3 hingga 9), di mana bagian atas pola mencetak angka secara **incremental** dari kiri ke kanan dan kembali menurun, lalu diikuti bagian bawah dengan pola yang menurun untuk membentuk diamond sempurna. Jika input tidak sesuai, program harus mencetak pesan error.
