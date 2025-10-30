<?php
// config.php — koneksi database PDO
require_once __DIR__ . '/helpers.php';

$env = parse_ini_file(__DIR__ . '/.env', false, INI_SCANNER_TYPED);
$dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
    $env['DB_HOST'] ?? '127.0.0.1',
    $env['DB_PORT'] ?? 3306,
    $env['DB_NAME'] ?? 'catynesia'
);
try {
    $pdo = new PDO($dsn, $env['DB_USER'] ?? 'root', $env['DB_PASS'] ?? '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    die("Koneksi database gagal. Silakan periksa konfigurasi.");
}
