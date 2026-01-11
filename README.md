# Proyek Perpustakaan

Berikut adalah **ERD (Entity Relationship Diagram)** untuk sistem perpustakaan:

## ERD Diagram

![ERD Diagram](assets/images/ERD%20Diagram.png)

# Penjelasan ERD (Entity Relationship Diagram) Sistem Perpustakaan

Diagram ini menggambarkan struktur hubungan antar entitas dalam sistem **Perpustakaan**. Berikut adalah penjelasan tentang entitas dan relasi di dalam diagram:

## Entitas

1. **Anggota**
   - **id_anggota** (PK): Identifikasi unik anggota.
   - **nama**: Nama anggota.
   - **no_hp**: Nomor telepon anggota.
   - **email**: Alamat email anggota.
   - **alamat**: Alamat anggota.
   - **tgl_bergabung**: Tanggal bergabung anggota di perpustakaan.

2. **Staff**
   - **id_staff** (PK): Identifikasi unik staff.
   - **nama**: Nama staff.
   - **email**: Email staff.
   - **no_hp**: Nomor telepon staff.
   - **posisi**: Posisi/jabatan staff di perpustakaan.

3. **Buku**
   - **id_buku** (PK): Identifikasi unik buku.
   - **judul**: Judul buku.
   - **pengarang**: Pengarang buku.
   - **tahun_terbit**: Tahun terbit buku.
   - **penerbit**: Penerbit buku.
   - **stok**: Jumlah stok buku yang tersedia.

4. **Peminjaman**
   - **id_peminjaman** (PK): Identifikasi unik peminjaman.
   - **id_anggota** (FK): Referensi ke anggota yang meminjam buku.
   - **id_staff** (FK): Referensi ke staff yang melayani peminjaman.
   - **tgl_pinjaman**: Tanggal peminjaman buku.
   - **tgl_kembali**: Tanggal pengembalian buku.

5. **Item_Peminjaman**
   - **id_itemPeminjaman** (PK): Identifikasi unik item peminjaman.
   - **id_peminjaman** (FK): Referensi ke peminjaman yang terkait.
   - **id_buku** (FK): Referensi ke buku yang dipinjam.

## Relasi Antar Entitas

1. **Anggota - Peminjaman**:
   - Setiap **Anggota** dapat melakukan lebih dari satu peminjaman, yang berarti ada hubungan *one-to-many* antara **Anggota** dan **Peminjaman**.
   
2. **Peminjaman - Item_Peminjaman**:
   - Setiap **Peminjaman** dapat mencatat lebih dari satu item peminjaman (buku yang dipinjam), yang berarti ada hubungan *one-to-many* antara **Peminjaman** dan **Item_Peminjaman**.

3. **Item_Peminjaman - Buku**:
   - Setiap item peminjaman merujuk pada satu buku yang dipinjam. Ada hubungan *many-to-one* antara **Item_Peminjaman** dan **Buku**.

4. **Staff - Peminjaman**:
   - Setiap **Staff** melayani banyak peminjaman. Hubungan ini adalah *one-to-many* antara **Staff** dan **Peminjaman**.

5. **Buku - Peminjaman**:
   - **Buku** dapat dipinjam oleh banyak anggota melalui peminjaman yang berbeda. Ada hubungan *many-to-many* yang diwakili oleh **Item_Peminjaman** yang menghubungkan antara **Buku** dan **Peminjaman**.

## Penjelasan Relasi

- **Anggota - Melakukan - Peminjaman**: Anggota yang melakukan peminjaman buku.
- **Peminjaman - Memiliki - Item_Peminjaman**: Setiap peminjaman dapat memiliki beberapa item peminjaman, yang menunjukkan buku-buku yang dipinjam.
- **Staff - Menangani - Peminjaman**: Staff yang menangani atau mencatat peminjaman.
- **Buku - Dipinjam**: Buku yang dipinjam oleh anggota, dengan informasi terkait stok buku yang ada.

# Proyek Perpustakaan

Aplikasi **Sistem Perpustakaan** ini dibuat dengan menggunakan **Laravel (PHP)** dan **MySQL**, bertujuan untuk membantu perpustakaan dalam mengelola katalog buku dan pencatatan peminjaman buku. Pengguna dibagi menjadi dua peran, yaitu **Staff** dan **Anggota**. **Staff** memiliki hak akses untuk mengelola data buku, anggota, serta pencatatan peminjaman dan pengembalian buku. Sedangkan **Anggota** hanya dapat melihat katalog buku dan status peminjaman mereka.

## Fitur Utama

- **Login** untuk **staff**.
- **Hak akses berbasis peran**: **staff** (CRUD buku, catat pinjam/kembali, laporan), **anggota** (lihat buku).
- **Buku**: Menampilkan daftar buku, tambah, ubah, hapus.
- **Anggota**: Menampilkan daftar anggota, tambah, ubah, hapus.
- **Peminjaman**: Menampilkan daftar peminjaman, **Staff** dapat mencatat peminjaman buku, mencatat pengembalian, dan menetapkan tanggal jatuh tempo otomatis (7 hari setelah peminjaman).
- **Stok buku** otomatis berkurang saat dipinjam dan bertambah saat dikembalikan.
- **Laporan peminjaman aktif dan terlambat** hanya bisa dilihat**staff**.

## Metode Pengembangan

**Metode Pengembangan**: **Agile**  
**Alasan**: Dengan perkembangan fitur yang berkelanjutan dan perubahan yang lebih fleksibel, menggunakan metode **Agile** memberikan keuntungan dalam menyesuaikan aplikasi dengan kebutuhan yang berubah secara dinamis.  
**Tahapan**:  
1. **Analisis**  
2. **Desain**  
3. **Implementasi**  
4. **Pengujian**  
5. **Dokumentasi**  

## Diagram & Pemodelan


### Modul Buku
- Menampilkan katalog buku dan pencarian.
- Menambah, mengubah, menghapus buku (**khusus staff**).

### Modul Anggota
- Menampilkan daftar anggota dan pencarian berdasarkan nama/email.
- Menambah, mengubah, menghapus anggota (**khusus staff**).

### Modul Peminjaman
- **Staff** dapat mencatat peminjaman buku.
- Jatuh tempo otomatis ditetapkan +7 hari setelah tanggal peminjaman.
- Pengembalian buku dan stok buku otomatis diperbarui.
- Filter status peminjaman (aktif/kembali/terlambat).

### Modul Login
- Login untuk **staff** menggunakan **email** dan **password**.
- Logout untuk keluar dari sesi pengguna.

## Instalasi dan Pengaturan

1. **Clone repositori ini**:
   ```bash
   git clone https://github.com/username/repo-name.git
   cd repo-name


2. **Install dependencies:**:
   ```bash
   composer install


3. **Setel .env untuk pengaturan database:**:
   ```bash
   cp .env.example .env

4. **Atur database di .env:**:
   ```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

5. **Jalankan migrasi database:**:
   ```bash
   php artisan migrate

6. **Jalankan seeder:**:
   ```bash
   php artisan db:seed

7. **Jalankan aplikasi:**:
   ```bash
   php artisan serve

## Akun Login Default

Untuk memudahkan pengujian, sistem sudah dilengkapi dengan akun login default. Akun ini digunakan untuk login sebagai **Admin**. Berikut adalah informasi akun login default:

- **Email**: admin@gmail.com
- **Password**: password123

Akun ini dibuat melalui seeder yang ada di dalam proyek untuk memudahkan pendaftaran pengguna pertama kali. Seeder ini akan otomatis membuat pengguna dengan email dan password default pada saat pertama kali aplikasi dijalankan.

