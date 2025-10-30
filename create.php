<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $breed = trim($_POST['breed']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'] ?? '';
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $photo = 'cat-placeholder.png';

    if (!empty($_FILES['photo']['name'])) {
        $file = $_FILES['photo'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png']) && $file['size'] < 2*1024*1024) {
            $photo = uniqid('cat_').'.'.$ext;
            move_uploaded_file($file['tmp_name'], "uploads/".$photo);
        }
    }

    if ($name) {
        $stmt = $pdo->prepare("INSERT INTO cats (name, breed, age, gender, location, description, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $breed, $age, $gender, $location, $description, $photo]);
        set_flash('success', 'Kucing berhasil ditambahkan!');
        redirect('index.php');
    } else {
        set_flash('error', 'Nama wajib diisi.');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Tambah Kucing</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Tambah Kucing Baru 🐾</h1></header>
<div class="form-container">
<form method="post" enctype="multipart/form-data">
<label>Nama:</label><input name="name" required>
<label>Ras:</label><input name="breed">
<label>Umur:</label><input type="number" name="age" min="0">
<label>Jenis Kelamin:</label>
<select name="gender"><option value="">--Pilih--</option><option>Male</option><option>Female</option></select>
<label>Lokasi:</label><input name="location">
<label>Deskripsi:</label><textarea name="description"></textarea>
<label>Foto:</label><input type="file" name="photo" accept="image/*">
<button type="submit" class="btn">Simpan</button>
<a href="index.php" class="btn-secondary">Kembali</a>
</form>
</div>
</body>
</html>
