# 🐾 Catynesia CRUD (PHP Native + PDO)

Aplikasi CRUD sederhana berbasis PHP native (tanpa framework) untuk mengelola data kucing di komunitas **Catynesia — Donasi & Adopsi Kucing Online**.  
Dibuat untuk keperluan pembelajaran dan evaluasi Post Test PHP.

---

## ✨ Fitur

1. **Create**
   - Form tambah data dengan validasi sisi server.
   - Tampilkan pesan sukses/gagal.

2. **Read**
   - Tabel daftar data lengkap (urut berdasarkan `created_at DESC`).
   - Kolom kunci (`id`) ikut ditampilkan.
   - Pagination (5 data per halaman).

3. **Detail**
   - Halaman detail per kucing dengan informasi lengkap.

4. **Update**
   - Form edit dengan prefill data.

5. **Delete**
   - Tombol hapus dengan konfirmasi.
   - Menggunakan token session untuk mencegah CSRF sederhana.

6. **Search**
   - Pencarian data berdasarkan kolom `name` atau `breed`.

7. **Validasi & Sanitasi**
   - Input dibersihkan sebelum disimpan.
   - Output disanitasi dengan `htmlspecialchars()`.
   - Query menggunakan `PDO prepared statements` (aman dari SQL Injection).

8. **Error Handling**
   - Pesan error informatif, tidak menampilkan stack trace ke user.
   - Error detail disimpan ke log server (via `error_log()`).

---

## ⚙️ Kebutuhan Sistem

- PHP **≥ 8.0**
- MySQL / MariaDB
- Laragon / XAMPP / Localhost environment
- Browser modern (Chrome, Edge, Firefox)

---

## 🚀 Instalasi & Konfigurasi

1. **Clone atau copy folder proyek**
   ```bash
   C:\laragon\www\catynesia
"# Tugas_Web_30-10" 
