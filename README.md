cara menjalankan program 

Langkah	Keterangan
Backup Project	Copy folder Laravel
Backup Database	Export dari phpMyAdmin
Pindah ke Laptop Baru	Install XAMPP, Composer, Git

xampp : https://www.apachefriends.org/
Composer : https://getcomposer.org/
nodejs : https://nodejs.org/id
git : https://git-scm.com/

Restore Project	Paste project, jalankan composer install
Restore Database	Import SQL
Konfigurasi	Cek .env, buat storage link
Sukses	Jalankan php artisan serve

✅ 1. Backup Semua File & Project Laravel
Dari laptop lama, lakukan hal ini:

🧩 A. Backup Project Laravel
Masuk ke folder proyek Laravel kamu (misalnya: media-fotografi).

Salin seluruh folder proyek ke flashdisk, external hard drive, atau upload ke Google Drive / GitHub.

WAJIB: Sertakan semua folder termasuk .env dan public, routes, app, resources, database, dll.

bash
Salin
Edit
cp -r media-fotografi /media/usb/  # (Linux/macOS)
🗃️ B. Backup Database
Jika kamu menggunakan MySQL / MariaDB / phpMyAdmin, lakukan export:

Cara Manual via phpMyAdmin:
Buka phpMyAdmin.

Pilih database proyek Laravel kamu.

Klik Export > pilih Quick > Format: SQL > lalu Go.

Simpan file .sql itu (misal mediafotografi.sql).

Atau via terminal:
bash
Salin
Edit
mysqldump -u root -p nama_database > backup.sql
✅ 2. Siapkan Laptop Baru
🧱 A. Install Semua Tool yang Dibutuhkan
XAMPP / Laragon (untuk Apache & MySQL)

Composer

Node.js (jika kamu menggunakan npm/webpack/vite)

Git (kalau pakai Git)

✅ 3. Pindahkan File ke Laptop Baru
Copy folder proyek Laravel ke folder baru di laptop baru.

Pastikan file .env ikut disalin.

✅ 4. Install Dependency di Laptop Baru
Masuk ke folder proyek, lalu jalankan:
bash
Salin
Edit
composer install
Kalau pakai npm juga:

bash
Salin
Edit
npm install && npm run dev
✅ 5. Buat Database Baru
Buka phpMyAdmin di laptop baru.

Buat database baru dengan nama yang sama seperti di .env file.

Import file .sql hasil backup tadi.

✅ 6. Atur .env
Pastikan .env sudah sesuai, contohnya:

dotenv
Salin
Edit
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mediafotografi
DB_USERNAME=root
DB_PASSWORD=
✅ 7. Generate App Key & Jalankan Laravel
bash
Salin
Edit
php artisan key:generate
php artisan migrate --force  # jika belum ada isi
php artisan serve
🔐 Jika Upload File via Storage
Jika kamu menggunakan storage/app/public, jalankan:

bash
Salin
Edit
php artisan storage:link
