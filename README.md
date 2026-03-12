# ☕ LogosCoffee

LogosCoffee adalah proyek website coffee shop yang dibangun untuk menampilkan brand, menu kopi, serta pengalaman browsing produk bagi pelanggan. Proyek ini menggunakan pendekatan Laravel Blade templating dengan arsitektur Model–View–Controller (MVC) untuk menjaga struktur kode tetap terorganisir dan mudah dikembangkan.

## Repository ini dapat digunakan sebagai:

- Portfolio project untuk Fullstack / Backend Developer
- Prototype website untuk bisnis coffee shop
- Referensi implementasi Laravel Blade architecture
- Project akademik atau tugas akhir

# 📌 Project Overview

- Website LogosCoffee dirancang untuk memberikan tampilan digital bagi coffee shop dengan tujuan:
- Menampilkan identitas brand coffee shop
- Menyediakan katalog menu kopi
- Menyajikan informasi produk
- Memberikan pengalaman UI yang sederhana dan responsif
- Struktur proyek menggunakan Blade template engine sehingga tampilan dapat dipisahkan dari logika aplikasi.

# ✨ Features
Landing Page

Halaman utama website yang menampilkan identitas brand coffee shop.

## Fungsi utama:

- Hero section
- Highlight produk kopi
- Navigasi ke menu
- Informasi singkat coffee shop
- Coffee Menu
- Halaman yang menampilkan daftar produk kopi.

## Informasi yang ditampilkan:

- Nama produk
- Deskripsi kopi
- Harga
- Gambar produk
- Product Display
- Setiap produk dapat ditampilkan dengan informasi yang jelas untuk membantu pelanggan mengenal produk.
- Responsive Design

## Website dirancang agar dapat berjalan pada berbagai perangkat:

- Desktop
- Tablet
- Smartphone

# 🖥️ Tech Stack
## Backend
- PHP
- Laravel Framework

## Frontend
- Blade Template Engine
- HTML5
- CSS3
- JavaScript

## Database
- Database yang direkomendasikan:
- MySQL
- MariaDB

# 🧠 Architecture

Aplikasi mengikuti pola arsitektur Model–View–Controller (MVC).

## Model
- Model bertanggung jawab untuk:
- Interaksi database
- Menyimpan logika bisnis
- Mengambil data produk

## View
- View menggunakan Blade templates.

## Tugas utama:

- Menampilkan tampilan UI
- Menyusun layout halaman
- Menampilkan data dari controller
- Controller

## Controller bertugas untuk:

- Mengelola HTTP request
- Mengambil data dari model
- Mengirim data ke view

# 📂 Project Structure

## Contoh struktur project:
```bash
LogosCoffee
│
├── app
│   ├── Models
│   └── Http
│       └── Controllers
│
├── resources
│   └── views
│       ├── layouts
│       ├── pages
│       └── components
│
├── public
│   ├── css
│   ├── js
│   └── images
│
├── routes
│   └── web.php
│
├── database
│
└── README.md
```
Penjelasan struktur:
