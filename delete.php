<?php
require_once 'config.php';
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("DELETE FROM cats WHERE id=?");
$stmt->execute([$id]);
set_flash('success', 'Data kucing telah dihapus!');
redirect('index.php');
