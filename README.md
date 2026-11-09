# 📄 README.md — Saja

Langsung copy-paste ke `README.md` di root project.

---

```markdown
# 📝 Task Manager — Laravel

> Aplikasi manajemen tugas dengan Laravel 13 — hasil migrasi dari [versi PHP Native (PDO)](https://github.com/wwibi11/task-meneger-native).

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Struktur Folder Penting](#-struktur-folder-penting)
- [Instalasi](#-instalasi)
- [Cara Menjalankan](#-cara-menjalankan)
- [Perbandingan dengan Versi Native](#-perbandingan-dengan-versi-native)
- [Tujuan Pembelajaran](#-tujuan-pembelajaran)
- [Roadmap](#️-roadmap)
- [Lisensi](#-lisensi)

---

## 🎯 Tentang Proyek

**Task Manager** adalah aplikasi CRUD tugas yang dibangun dengan **Laravel 13** sebagai kelanjutan dari [versi PHP Native (PDO)](https://github.com/wwibi11/task-meneger-native).

Aplikasi yang sama — CRUD tugas dengan prioritas, deadline, filter, sorting, dan statistik — tapi diimplementasikan ulang memakai **Eloquent ORM**, **Blade Template**, **Migration**, dan **Resource Controller**.

Tujuan utamanya bukan menambah fitur baru, melainkan **membandingkan langsung** bagaimana konsep yang ditulis manual di PHP native (PDO, validasi manual, `header()` redirect, escape HTML) menjadi jauh lebih ringkas dan ekspresif di Laravel.

---

## ✨ Fitur

| Fitur | Deskripsi |
|-------|-----------|
| ✅ **CRUD Task** | Tambah, lihat, edit, dan hapus tugas |
| 🎯 **Prioritas** | Rendah, Sedang, Tinggi dengan badge berwarna |
| 📅 **Deadline** | Deteksi otomatis tugas yang sudah terlambat |
| 🔄 **Toggle Status** | Tandai selesai / belum selesai dengan satu klik |
| 📊 **Statistik Ringkas** | Total, selesai, belum, dan terlambat |
| 🎨 **Tampilan Modern** | Card dengan hover, badge emoji, form responsif |
| 🛡️ **Validasi Otomatis** | Menggunakan `$request->validate()` |
| 🔒 **CSRF Protection** | Setiap form dilindungi token `@csrf` |

---

## 🧰 Teknologi

| Komponen | Keterangan |
|----------|------------|
| **PHP** | 8.3+ |
| **Framework** | Laravel 13.x |
| **Database** | MySQL / MariaDB |
| **ORM** | Eloquent |
| **Template** | Blade |
| **CSS** | Custom (tanpa framework) |
| **Build Tool** | Vite (bawaan Laravel) |

---

## 📁 Struktur Folder Penting

```
task-manager-laravel/
├── app/
│   ├── Http/Controllers/
│   │   └── TaskController.php          # Semua logika CRUD
│   └── Models/
│       └── Task.php                    # Model Eloquent
│
├── database/
│   └── migrations/
│       └── xxxx_create_tasks_table.php # Struktur tabel daftar_tugas
│
├── public/
│   └── css/
│       └── style.css                   # Stylesheet
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           # Layout utama
│       ├── index.blade.php             # Daftar tugas
│       └── tasks/
│           ├── create.blade.php        # Form tambah
│           └── edit.blade.php          # Form edit
│
├── routes/
│   └── web.php                         # Route resource + toggle
│
├── .env                                # Konfigurasi (DB, app key, dll)
├── .env.example                        # Template .env
└── README.md
```

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/wwibi11/task-manager-laravel.git
cd task-manager-laravel
```

### 2. Install Dependency

```bash
composer install
```

### 3. Salin `.env` & Generate Key

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Buat Database

Buat database `task_manager_laravel` di MySQL / phpMyAdmin:

```sql
CREATE DATABASE task_manager_laravel;
```

### 5. Sesuaikan Kredensial DB di `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migrasi

```bash
php artisan migrate
```

### 7. Jalankan Server

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000/tasks`.

---

## 🖥️ Cara Menjalankan

### Dengan `php artisan serve`

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`.

### Dengan Laragon / XAMPP

Pindahkan folder project ke `www/` (Laragon) atau `htdocs/` (XAMPP), lalu akses lewat virtual host atau `http://localhost/task-manager-laravel/public`.

---

## 🔄 Perbandingan dengan Versi Native

Ini bagian yang paling menarik — implementasi yang sama, ditulis dengan dua pendekatan berbeda.

| Konsep | PHP Native | Laravel |
|--------|------------|---------|
| Koneksi DB | `new PDO(...)` manual | Otomatis via `.env` |
| Query data | `$pdo->query("SELECT * FROM ...")` | `Task::all()` |
| Insert | `$pdo->prepare("INSERT ...")` | `Task::create($data)` |
| Update | `$pdo->prepare("UPDATE ...")` | `$task->update($data)` |
| Delete | `$pdo->prepare("DELETE ...")` | `$task->delete()` |
| Validasi | `if ($judul === '') { $error = '...' }` | `$request->validate(['judul' => 'required'])` |
| Redirect | `header("Location: index.php")` | `return redirect()->route('tasks.index')` |
| Escape HTML | `htmlspecialchars($var)` | `{{ $var }}` (otomatis) |
| Layout | `require 'header.php'` | Blade `@extends('layouts.app')` |
| Routing | Nama file = URL | `Route::resource('tasks', ...)` |
| Form keamanan | Manual | `@csrf` (wajib) |
| Method PUT/DELETE | Tidak didukung | `@method('PUT')` / `@method('DELETE')` |

---

## 🎓 Tujuan Pembelajaran

Proyek ini dibuat sebagai **latihan migrasi dari PHP Native ke Laravel**. Konsep yang dilatih:

- **Eloquent ORM** — menggantikan PDO manual
- **Migration** — menggantikan `CREATE TABLE` via SQL
- **Resource Controller** — menggantikan file-file `actions/*.php`
- **Form Request / Validation** — menggantikan `if ($var === '')` manual
- **Blade Template** — menggantikan `header.php` / `footer.php` + escape manual
- **Named Routes** — menggantikan `header("Location: ...")`
- **Mass Assignment** (`$fillable`) — menggantikan insert manual per kolom
- **Method Spoofing** — `@method('PUT')` dan `@method('DELETE')`
- **CSRF Protection** — keamanan form yang tidak ada di native

---

## 🗺️ Roadmap

- [x] Setup Laravel 13 + MySQL
- [x] Model & Migration `Task`
- [x] Resource Controller & Routes
- [x] Blade layout + views (index, create, edit)
- [x] Toggle status & delete
- [x] Statistik ringkas
- [x] Tampilan modern (card, badge, form responsif)
- [ ] Filter status (`?filter=belum|selesai`)
- [ ] Sorting dinamis (`?sort=deadline|prioritas|terbaru`)
- [ ] Highlight task terlambat di card
- [ ] Form Request untuk validasi
- [ ] Feature Test (PHPUnit)
- [ ] Auth (Breeze) — opsional

---

## 🔗 Repo Terkait

- 📦 [Versi PHP Native (PDO)](https://github.com/wwibi11/task-meneger-native) — titik awal perjalanan belajar

---

## 📄 Lisensi

Didistribusikan di bawah **MIT License**. Bebas digunakan untuk belajar.

---

<p align="center">
  Dibuat dengan ❤️ sebagai latihan migrasi dari PHP Native ke Laravel
</p>
```

---

Tinggal copy-paste, simpan, lalu:

```powershell
git add README.md
git commit -m "docs: add comprehensive README"
git push
```

Kalau mau lanjut ke **filter + sorting**, tinggal bilang. 🚀