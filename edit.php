<?php
require_once 'config.php';
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cats WHERE id=?");
$stmt->execute([$id]);
$cat = $stmt->fetch();

if (!$cat) die("Data tidak ditemukan.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $breed = trim($_POST['breed']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $photo = $cat['photo'];

    if (!empty($_FILES['photo']['name'])) {
        $file = $_FILES['photo'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png']) && $file['size'] < 2*1024*1024) {
            $photo = uniqid('cat_').'.'.$ext;
            move_uploaded_file($file['tmp_name'], "uploads/".$photo);
        }
    }

    $stmt = $pdo->prepare("UPDATE cats SET name=?, breed=?, age=?, gender=?, location=?, description=?, photo=? WHERE id=?");
    $stmt->execute([$name, $breed, $age, $gender, $location, $description, $photo, $id]);
    set_flash('success', 'Data berhasil diperbarui!');
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Edit Kucing</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Edit Data Kucing 🐱</h1></header>
<div class="form-container">
<form method="post" enctype="multipart/form-data">
<img src="uploads/<?= e($cat['photo']) ?>" width="120" style="border-radius:10px;">
<label>Nama:</label><input name="name" value="<?= e($cat['name']) ?>" required>
<label>Ras:</label><input name="breed" value="<?= e($cat['breed']) ?>">
<label>Umur:</label><input type="number" name="age" value="<?= e($cat['age']) ?>">
<label>Jenis Kelamin:</label>
<select name="gender">
<option <?= $cat['gender']=='Male'?'selected':'' ?>>Male</option>
<option <?= $cat['gender']=='Female'?'selected':'' ?>>Female</option>
</select>
<label>Lokasi:</label><input name="location" value="<?= e($cat['location']) ?>">
<label>Deskripsi:</label><textarea name="description"><?= e($cat['description']) ?></textarea>
<label>Ganti Foto:</label><input type="file" name="photo" accept="image/*">
<button type="submit" class="btn">Update</button>
<a href="index.php" class="btn-secondary">Batal</a>
</form>
</div>
</body>
</html>
