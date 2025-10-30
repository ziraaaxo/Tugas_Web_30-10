<?php
require_once 'config.php';
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cats WHERE id=?");
$stmt->execute([$id]);
$cat = $stmt->fetch();
if (!$cat) die("Data tidak ditemukan");
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Detail Kucing</title><link rel="stylesheet" href="style.css"></head>
<body>
<header><h1>Detail Kucing 🐾</h1></header>
<div class="detail">
<img src="uploads/<?= e($cat['photo']) ?>" alt="<?= e($cat['name']) ?>" class="detail-img">
<p><strong>Nama:</strong> <?= e($cat['name']) ?></p>
<p><strong>Ras:</strong> <?= e($cat['breed']) ?></p>
<p><strong>Umur:</strong> <?= e($cat['age']) ?> tahun</p>
<p><strong>Jenis Kelamin:</strong> <?= e($cat['gender']) ?></p>
<p><strong>Lokasi:</strong> <?= e($cat['location']) ?></p>
<p><strong>Deskripsi:</strong> <?= e($cat['description']) ?></p>
<a href="index.php" class="btn-secondary">Kembali</a>
</div>
</body>
</html>
