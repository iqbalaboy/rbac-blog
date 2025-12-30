RBAC Blog – Keamanan Basis Data
Deskripsi Singkat
RBAC Blog adalah aplikasi blog berbasis Laravel yang menerapkan Role-Based Access Control (RBAC) dan Audit Log sebagai mekanisme utama keamanan basis data. Sistem ini dirancang untuk mengontrol hak akses pengguna berdasarkan peran serta mencatat seluruh aktivitas penting pengguna sebagai bentuk pengawasan dan validasi keamanan.
Proyek ini dikembangkan sebagai bagian dari mata kuliah Keamanan Basis Data.

Fitur Utama
- Autentikasi pengguna
- Role-Based Access Control (Admin, Editor, Author)
- Manajemen post (create, update, publish)
- Audit log aktivitas pengguna
- Kontrol akses berbasis middleware

Teknologi yang Digunakan
- Laravel 12
- PHP 8.2
- MySQL
- Tailwind CSS
- Blade Template
- Laravel Breeze
Struktur Role dan Akses
Role	Akses Utama
Admin	Manajemen user, role, audit log, dan seluruh post
Editor	Review, edit, dan publish post
Author	Membuat dan mengelola post milik sendiri


Cara Instalasi Singkat
1.	Clone Repository
-	git clone https://github.com/iqbalaboy/rbac-blog.git
-	cd rbac-blog
2.	Install Dependency
-	composer install
-	npm install
-	npm run build
3.	Konfigurasi Environment
-	cp .env.example .env
-	php artisan key:generate
Atur database di file .env.

4.	Migrasi Database
-	php artisan migrate --seed

5.	Jalankan Aplikasi
-	php artisan serve
Akses melalui browser:
http://127.0.0.1:8000

Keamanan Sistem
- 	Pembatasan akses menggunakan middleware RBAC
-   Validasi hak akses di setiap route penting
- 	Audit log mencatat:
    - User
    - Action
    - Waktu
    - IP Address
    - Objek yang diakses

Tujuan Pembelajaran
-	Menerapkan konsep RBAC dalam aplikasi nyata
-	Mengimplementasikan audit log sebagai kontrol keamanan
-	Memahami kontrol akses pada basis data
-	Melakukan validasi keamanan sistem
