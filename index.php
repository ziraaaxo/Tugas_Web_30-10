<?php
require_once 'config.php';

$limit = 8;
$page = max(1, (int)($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$keyword = trim($_GET['q'] ?? '');

if ($keyword) {
    $stmt = $pdo->prepare("SELECT * FROM cats WHERE name LIKE :kw OR breed LIKE :kw ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':kw', "%$keyword%");
} else {
    $stmt = $pdo->prepare("SELECT * FROM cats ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = $pdo->query("SELECT COUNT(*) FROM cats")->fetchColumn();
$total_pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catynesia - Daftar Kucing</title>
<link rel="stylesheet" href="style.css">
<script src="script.js" defer></script>
</head>
<body>
<header>
  <h1>Daftar Kucing yang Siap Diadopsi 🐾</h1>
  <button id="toggle-dark">🌙</button>
</header>

<div class="container">
  <div class="top-bar">
    <form method="get" class="search">
      <input type="text" name="q" placeholder="Cari kucing..." value="<?= e($keyword) ?>">
      <button>Cari</button>
    </form>
    <a href="create.php" class="btn">+ Tambah Kucing</a>
  </div>

  <?php if ($msg = get_flash('success')): ?>
    <div class="flash success"><?= e($msg) ?></div>
  <?php elseif ($msg = get_flash('error')): ?>
    <div class="flash error"><?= e($msg) ?></div>
  <?php endif; ?>

  <div class="card-grid">
    <?php foreach ($cats as $cat): ?>
    <div class="card">
      <img src="uploads/<?= e($cat['photo']) ?>" alt="<?= e($cat['name']) ?>">
      <h3><?= e($cat['name']) ?></h3>
      <p><?= e($cat['breed']) ?>, <?= e($cat['age']) ?> thn</p>
      <div class="actions">
        <a href="detail.php?id=<?= $cat['id'] ?>" class="btn-secondary">Detail</a>
        <a href="edit.php?id=<?= $cat['id'] ?>" class="btn">Edit</a>
        <a href="delete.php?id=<?= $cat['id'] ?>" class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="pagination">
    <?php for ($i=1; $i <= $total_pages; $i++): ?>
      <a href="?page=<?= $i ?><?= $keyword ? '&q='.urlencode($keyword):'' ?>" class="<?= $i==$page?'active':'' ?>"><?= $i ?></a>
    <?php endfor; ?>
  </div>
</div>

<footer><p>© 2025 Catynesia 🐱</p></footer>
</body>
</html>
