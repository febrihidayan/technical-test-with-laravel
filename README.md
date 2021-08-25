# Technical Test With Laravel

### Persyaratan
Beberapa aplikasi umum harus sudah di instal seperti *Text Editor*, *Web Browser*, dan *Local Server* (Xampp, Mamp, atau Laragon).

**Instalasi Wajib**
- Composer
- Git (opsional)
- Node.js dan Yarn (opsional)

**Syarat Laravel**
- PHP >= 7.4

### Berikut cara menggunakannya

1. Buka terminal atau CMD, kemudian jalankan perintah berikut:
   ```bash
   git clone https://github.com/febrihidayan/technical-test-with-laravel.git
   ```
   > Atau bisa langsung unduh projek ini agar tidak melalui Git.
2. Jalankan juga `composer install`
3. (opsional) jalankan `yarn` atau `npm install` kemudian `yarn watch` atau `npm run watch`
4. Lakukan konfigurasi nama basis data `interviewweblaravel`
5. Jalankan `php artisan migrate` dan `php artisan db:seed`
6. Jalankan aplikasi `php artisan serve` (http://127.0.0.1:8000)
7. Setelah itu masuk ke halaman login dengan memasukan
   email: febri@app.com
   pass: password