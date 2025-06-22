## 📦 Gudang App – Laravel REST API untuk Manajemen Gudang Alat Konstruksi

**Developer:** Kamila Aurellia\
**Deskripsi:**\
Proyek ini merupakan bagian dari proses interview, berupa REST API sederhana untuk manajemen gudang alat konstruksi. API ini dibangun menggunakan Laravel 11, Sanctum, SQLite, dan Docker untuk kebutuhan development lokal.

---

### ✅ Fitur Utama

- Autentikasi (Login & Register) menggunakan Laravel Sanctum
- CRUD untuk:
  - Produk
  - Lokasi
  - Mutasi Produk antar Lokasi
- Dokumentasi API via Postman
- SQLite + Dockerized Environment

---

### 🚀 Cara Menjalankan Proyek

#### 1. Clone Repository

```bash
git clone https://github.com/kamilaaura/gudang-app.git
cd gudang-app
```

#### 2. Jalankan dengan Docker

```bash
docker-compose up -d --build
docker exec -it laravel-app bash
```

#### 3. Buat Database SQLite & Migrate

```bash
touch database/database.sqlite
php artisan migrate
```

#### 4. Generate App Key

```bash
php artisan key:generate
```

#### 5. Jalankan Server

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

---

### 🔐 Autentikasi

Gunakan endpoint:

- `POST /api/register` – Untuk registrasi
- `POST /api/login` – Mendapatkan token akses

Gunakan token ini di header sebagai:

```
Authorization: Bearer <token>
```

---

### 📦 Endpoints API

#### 🔸 Produk

- `GET /api/produk`
- `POST /api/produk`
- `PUT /api/produk/{id}`
- `DELETE /api/produk/{id}`

#### 🔸 Lokasi

- `GET /api/lokasi`
- `POST /api/lokasi`
- `PUT /api/lokasi/{id}`
- `DELETE /api/lokasi/{id}`

#### 🔸 Mutasi

- `POST /api/mutasi`
- `GET /api/mutasi/produk/{id}` – History berdasarkan Produk
- `GET /api/mutasi/user/{id}` – History berdasarkan User
- `GET /user/{id}/history` – Alternatif endpoint history user
- `PUT /api/mutasi/{id}`
- `DELETE /api/mutasi/{id}`

---

### 📬 Dokumentasi Postman

File koleksi Postman tersedia di:

- [`gudang-app.postman_collection.json`](./gudang-app.postman_collection.json)

---

### 🙋‍♀️ Tentang Saya

Saya Kamila Aurellia, seorang developer yang antusias dalam membangun API sederhana dan bersih. Proyek ini dibuat sebagai bukti kemampuan saya dalam menangani proses otentikasi, relasi antar tabel, hingga deployment sederhana dengan Docker.

---

> Terima kasih telah mereview proyek ini!

