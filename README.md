 RBAC Blog Laravel
Aplikasi blog berbasis Laravel yang menerapkan Role-Based Access Control (RBAC), sistem manajemen konten, serta audit log untuk mencatat aktivitas pengguna secara sistematis.

📌 Gambaran Umum
RBAC Blog merupakan aplikasi blog yang dibangun menggunakan Laravel dengan fokus pada pengelolaan hak akses pengguna berdasarkan peran (role).
Aplikasi ini mendukung tiga peran utama, yaitu Admin Editor dan Author yang masing-masing memiliki hak akses berbeda.
Selain itu, aplikasi ini dilengkapi dengan sistem audit log untuk mencatat aktivitas penting pengguna sebagai bentuk transparansi dan keamanan sistem.

 ✨ Fitur Utama
 🔐 Autentikasi dan Otorisasi
- Autentikasi pengguna menggunakan Laravel Breeze
- Role-Based Access Control menggunakan middleware
- Tiga peran pengguna: Admin, Editor, dan Author

 📝 Manajemen Blog
- Membuat, mengedit, dan menghapus artikel
- Sistem publikasi dan review artikel
- Menampilkan daftar artikel yang telah dipublikasikan
- Halaman detail artikel

 🧑‍💼 Manajemen Pengguna (Admin)
- Melihat daftar pengguna
- Mengubah peran pengguna
- Mengelola akses pengguna
 📊 Sistem Audit Log
- Pencatatan otomatis aktivitas pengguna
- Informasi log meliputi:
  - Pengguna
  - Aksi
  - Deskripsi
  - Alamat IP
  - Waktu kejadian
- Fitur filter audit log berdasarkan pengguna dan aksi

 🎨 Antarmuka Pengguna
- Menggunakan Tailwind CSS
- Desain responsif
- Tampilan artikel berbasis grid
- Dashboard admin yang bersih dan modern

 ⚙️ Teknologi yang Digunakan
- Framework: Laravel 12
- Frontend: Blade Template, Tailwind CSS
- Database: MySQL
- Autentikasi: Laravel Breeze
- Otorisasi: Middleware RBAC
- Logging: Audit Log Kustom

 🚀 Instalasi dan Menjalankan Aplikasi
1.	Clone Repository
-	git clone https://github.com/iqbalaboy/rbac-blog.git
-	cd rbac-blog
2.	Install Dependency
-	composer install
-	npm install && npm run build
3.	Konfigurasi Environment
-	cp .env.example .env
-	php artisan key:generate
Atur koneksi database pada file `.env`.
4.	Migrasi Database dan Seeder
-	php artisan migrate –seed
5.	Membuat Storage Link
-	php artisan storage:link
6.	Menjalankan Aplikasi
-	php artisan serve
Akses aplikasi melalui browser di `http://localhost:8000`.

🧪 Peran Default
Peran pengguna yang tersedia:
- admin
- editor
- author
Peran dapat diatur melalui database atau fitur manajemen pengguna oleh Admin.
