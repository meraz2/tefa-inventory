# 📦 TeFA Inventory System v1.2

## 🚀 Tentang Proyek

TeFA Inventory adalah sistem manajemen inventaris terintegrasi yang dirancang khusus untuk memonitor sirkulasi peminjaman barang di lingkungan TeFA (Teaching Factory). Sistem ini membantu admin dalam melacak ketersediaan stok, mengelola data peminjam, dan memantau log transaksi peminjaman secara real-time.

---

## ✨ Fitur Utama

- **Dashboard Ringkasan** — Pantau stok menipis dan total barang dengan visualisasi yang responsif.
- **Manajemen Inventaris** — Penambahan, pembaruan, dan pelacakan unit barang secara detail.
- **Log Transaksi** — Rekam jejak peminjaman dan pengembalian barang yang akurat.
- **Manajemen Peminjam** — Database terintegrasi untuk pendataan siswa atau pengguna unit.
- **Sistem Notifikasi** — Peringatan otomatis jika stok barang di bawah ambang batas *(low stock alert)*.

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| Framework | [Laravel 13](https://laravel.com/) |
| Frontend | [Tailwind CSS](https://tailwindcss.com/) |
| Database | [MySQL](https://www.mysql.com/) |
| Server | PHP 8.3 |

---

## 📦 Cara Instalasi

Pastikan Anda sudah menginstal **Composer** dan **Node.js** di perangkat Anda.

**1. Clone repository ini:**
```bash
git clone https://github.com/username-anda/tefa-inventory.git
cd tefa-inventory
```

**2. Instal dependensi PHP:**
```bash
composer install
```

**3. Siapkan file environment:**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Konfigurasi Database:**

Edit file `.env` dan sesuaikan dengan pengaturan database lokal Anda:
```env
DB_DATABASE=inventaris_tefa
DB_USERNAME=root
DB_PASSWORD=
```

**5. Jalankan migrasi:**
```bash
php artisan migrate
```

**6. Jalankan aplikasi:**
```bash
php artisan serve
```

---


## 🤝 Kontribusi

Jika Anda ingin berkontribusi dalam pengembangan sistem ini, silakan buat **Pull Request** atau ajukan **Issue** jika menemukan bug.

---

## 📄 Lisensi

Proyek ini bersifat open-source dan berada di bawah lisensi **MIT**.
