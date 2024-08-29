<?php
$kiriman = $_GET["data"];

// Display the received data
echo htmlspecialchars($kiriman); // Use htmlspecialchars to prevent XSS attacks

include "koneksi.php";

// Create a connection to the MySQL database
$connection = new mysqli("localhost", "root", "", "toko");

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare the SQL statement to prevent SQL injection
$stmt = $connection->prepare("DELETE FROM barang_masuk WHERE no_trx = ?");
$stmt->bind_param("s", $kiriman);

// Execute the statement
if ($stmt->execute()) {
?>
    <script type="text/javascript">
        alert('Data Berhasil di Hapus');
        window.location = 'index.php';
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        alert('Data Gagal di Hapus');
        window.location = 'index.php';
    </script>
<?php
}

// Close the statement and the database connection
$stmt->close();
$connection->close();
?>