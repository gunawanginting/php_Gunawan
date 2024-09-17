<?php
session_start();
if (!isset($_SESSION['nama'])) {
    $_SESSION['nama'] = '';
}
if (!isset($_SESSION['umur'])) {
    $_SESSION['umur'] = '';
}
if (!isset($_SESSION['hobi'])) {
    $_SESSION['hobi'] = '';
}
$langkah = isset($_POST['langkah']) ? intval($_POST['langkah']) : (isset($_GET['langkah']) ? intval($_GET['langkah']) : 1);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($langkah === 1) {
        $_SESSION['nama'] = $_POST['nama'] ?? '';
        $langkah = 2;
    } elseif ($langkah === 2) {
        $_SESSION['umur'] = $_POST['umur'] ?? '';
        $langkah = 3;
    } elseif ($langkah === 3) {
        $_SESSION['hobi'] = $_POST['hobi'] ?? '';
        $langkah = 4;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    </style>
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <input type="hidden" name="langkah" value="<?= $langkah ?>">

            <?php if ($langkah === 1): ?>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?=($_SESSION['nama']) ?>" required>
                </div>
                <button type="submit">Submit</button>

            <?php elseif ($langkah === 2): ?>
                <div class="form-group">
                    <label for="umur">Umur:</label>
                    <input type="text" id="umur" name="umur" value="<?=($_SESSION['umur']) ?>" required>
                </div>
                <button type="submit">Submit</button>

            <?php elseif ($langkah === 3): ?>
                <div class="form-group">
                    <label for="hobi">Hobi:</label>
                    <input type="text" id="hobi" name="hobi" value="<?=($_SESSION['hobi']) ?>" required>
                </div>
                <button type="submit">Submit</button>

            <?php elseif ($langkah === 4): ?>
                <div class="result">
                    <p>Nama : <?= ($_SESSION['nama']) ?></p>
                    <p>Umur : <?= ($_SESSION['umur']) ?></p>
                    <p>Hobi : <?= ($_SESSION['hobi']) ?></p>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
