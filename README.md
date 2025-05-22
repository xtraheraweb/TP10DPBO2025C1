# TP10DPBO2025C1

## Janji

Saya, **Safira Aliyah Azmi CI** dengan **NIM 2309209**, mengerjakan **Tugas Praktikum 10** dalam mata kuliah **DPBO** dengan sebaik-baiknya demi keberkahan-Nya.
Saya berjanji tidak melakukan  kecurangan sebagaimana yang sudah dispesifikasikan. **Aamiin.**

---

## Penjelasan Program

**Train Booking System**
Adalah aplikasi booking kereta api berbasis **PHP** yang menerapkan pola arsitektur **Model - View - ViewModel**.
Aplikasi ini dibuat buat manajemen data pemesanan tiket kereta, rute perjalanan, sama info kereta-nya.

### Modul Utama:

* Train (Kereta)
* Route (Rute)
* Booking (Pemesanan)

---

## Fitur

* **Manajemen Train (CRUD)**: Tambah, edit, hapus, dan lihat data kereta
* **Manajemen Route (CRUD)**: Tambah, edit, hapus, dan lihat data rute
* **Manajemen Booking (CRUD)**: Tambah, edit, hapus, dan lihat data pemesanan yang nyambung ke train & route

---

## Struktur Folder

```
PERTEMUAN-10/
│
├── program/
│   ├── config/
│   │   └── Database.php               ← koneksi database
│   │
│   ├── database/
│   │   └── train_booking_system.sql   ← struktur & seed data awal DB
│   │
│   ├── model/
│   │   ├── Booking.php               ← model tabel bookings
│   │   ├── Route.php                 ← model tabel routes
│   │   └── Train.php                 ← model tabel trains
│   │
│   ├── viewmodel/
│   │   ├── BookingViewModel.php      ← hubungin model Booking ke view
│   │   ├── RouteViewModel.php        ← hubungin model Route ke view
│   │   └── TrainViewModel.php        ← hubungin model Train ke view
│   │
│   └── views/
│       ├── booking/                  ← tampilan booking (form & list)
│       ├── route/                    ← tampilan route (form & list)
│       ├── train/                    ← tampilan train (form & list)
│       └── template/                 ← template layout umum
```
## Struktur Database

**Database: `train_booking_system`**

### Tabel: `trains`

| Kolom       | Tipe         |
| ----------- | ------------ |
| id          | int (PK)     |
| train\_name | varchar(100) |
| train\_type | varchar(50)  |
| capacity    | int          |
| created\_at | timestamp    |

---

### Tabel: `routes`

| Kolom              | Tipe         |
| ------------------ | ------------ |
| id                 | int (PK)     |
| departure\_station | varchar(100) |
| arrival\_station   | varchar(100) |
| distance\_km       | int          |
| duration\_hours    | decimal(3,1) |
| created\_at        | timestamp    |

---

### Tabel: `bookings`

| Kolom            | Tipe                                    |
| ---------------- | --------------------------------------- |
| id               | int (PK)                                |
| train\_id        | int (FK → trains.id)                    |
| route\_id        | int (FK → routes.id)                    |
| passenger\_name  | varchar(100)                            |
| passenger\_phone | varchar(20)                             |
| departure\_date  | date                                    |
| departure\_time  | time                                    |
| seat\_number     | varchar(10)                             |
| ticket\_price    | decimal(10,2)                           |
| booking\_status  | enum('confirmed','pending','cancelled') |
| created\_at      | timestamp                               |

---

## Komponen Sistem

### Model

* **Train.php**: Kelola data kereta (CRUD + PDO + prepared statement)
* **Route.php**: Kelola data rute (CRUD + PDO + prepared statement)
* **Booking.php**: Kelola data booking (CRUD + relasi ke kereta dan rute)

### ViewModel 

* Ngelink model ke view
* Nanganin logic & data biar bisa dipake di tampilan

### View 

* Form & list buat modul train, route, dan booking
* Sudah support data binding waktu edit form

## Hasil Record
Record --> https://drive.google.com/file/d/12nra5zSzNCpAVZK6138hydt-c4zlEaR-/view?usp=sharing 

