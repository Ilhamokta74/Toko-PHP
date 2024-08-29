<?php
// Get POST data
$a = $_POST['no'];
$b = $_POST['nama'];
$c = $_POST['harga'];
$d = $_POST['jumlah'];
$e = $_POST['total'];

// Include database connection
include "koneksi.php";

// Create a connection to the MySQL database
$connection = new mysqli("localhost", "root", "", "toko");

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare and execute the update query
$stmt = $connection->prepare("UPDATE barang_masuk SET nama_barang = ?, harga = ?, jumlah = ?, total = ? WHERE no_trx = ?");
$stmt->bind_param("siii", $b, $c, $d, $e, $a);

if ($stmt->execute()) {
?>
    <script type="text/javascript">
        alert('Data Berhasil di Mutakhirkan');
        window.location = 'index.php';
    </script>
<?php
} else {
    echo "Error updating record: " . $connection->error;
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>