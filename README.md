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
| Folder          | Fungsi                    |
| --------------- | ------------------------- |
| app             | Logic aplikasi            |
| resources/views | Template Blade            |
| public          | Static assets             |
| routes          | Routing Laravel           |
| database        | Migrasi dan seed database |

# 🚀 Installation Guide

## Ikuti langkah berikut untuk menjalankan project secara lokal.

1. Clone Repository
```bash
git clone https://github.com/goldieblink-dev/LogosCoffee.git
```
Masuk ke folder project:
```bash
cd LogosCoffee
```
2. Install Dependencies
```bash
composer install
```
4. Setup Environment
Copy file environment:
```bash
cp .env.example .env
```
Generate application key:
```bash
php artisan key:generate
```
4. Setup Database
Edit konfigurasi database di file .env.
Contoh:
```bash
DB_DATABASE=logoscoffee
DB_USERNAME=root
DB_PASSWORD=
```
Jalankan migrasi database:
```bash
php artisan migrate
```
5. Run Development Server
```bash
php artisan serve
```
Buka browser dan akses:
```bash
http://localhost:8000
```
# 📱 UI Design Concept

Desain UI pada LogosCoffee menekankan pada:

- Minimalist coffee shop aesthetic
- Warm color palette
- Simple navigation
- Product-focused layout

Pendekatan ini digunakan agar produk kopi menjadi fokus utama pada tampilan website.

# 🔧 Future Improvements

Project ini dapat dikembangkan lebih lanjut dengan menambahkan fitur berikut.

- Feature Development
- Online ordering system
- Shopping cart
- User authentication
- Order history
- Admin dashboard

Backend Enhancement

REST API
- Product management system
- Order management system
- Inventory management

# 🌐 Deployment

Website ini dapat dideploy ke server menggunakan beberapa metode.

VPS Deployment
Stack yang direkomendasikan:

- Ubuntu Server
- Nginx
- PHP-FPM
- MySQL

## Contoh alur deployment:
```bash
GitHub Repository
        ↓
VPS Server
        ↓
Web Server (Nginx)
        ↓
Public Domain
```
# 📊 Project Purpose

## Tujuan utama dari proyek ini adalah:

- Demonstrasi kemampuan pengembangan web
- Implementasi struktur MVC
- Menjadi prototype website coffee shop
- Menjadi bagian dari portfolio developer

# 👨‍💻 Author

Rendy Julkifli Usman
Abian Nurhuda Pratama

Fullstack Developer dengan fokus pada backend engineering dan pengembangan sistem web.

## Area ketertarikan:

- Backend Development
- Web Architecture
- DevOps Practices
- Scalable Web Systems

GitHub:
```bash
https://github.com/goldieblink-dev
https://github.com/AbianNurhuda
```
