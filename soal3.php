<?php
$host = 'localhost';
$db = 'testdb';
$user = 'root'; 
$pass = ''; 
$conn = new mysqli($host, $user, $pass, $db);
$searchQuery = "";
if (isset($_POST['search'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $hobi = $conn->real_escape_string($_POST['hobi']);
    $searchQuery = "WHERE p.nama LIKE '%$nama%' AND p.alamat LIKE '%$alamat%' AND h.hobi LIKE '%$hobi%'";
}
$sql = "
    SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobis
    FROM person p
    LEFT JOIN hobi h ON p.id = h.person_id
    $searchQuery
    GROUP BY p.id
    LIMIT 5
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Person dan Hobi</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['hobis']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Pencarian</h2>
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat">
        <br>
        <label for="hobi">Hobi:</label>
        <input type="text" id="hobi" name="hobi">
        <br>
        <button type="submit" name="search">Cari</button>
    </form>

    <?php $conn->close(); ?>
