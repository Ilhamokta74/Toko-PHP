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

// Prepare and execute the query to check if the record exists
$stmt = $connection->prepare("SELECT * FROM barang_masuk WHERE no_trx = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
	echo "Data Sudah Ada";
	exit;
} else {
	// Prepare and execute the query to insert new record
	$stmt = $connection->prepare("INSERT INTO barang_masuk (no_trx, nama_barang, harga, jumlah, total) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("ssiii", $a, $b, $c, $d, $e);
	$stmt->execute();

	// Prepare and execute the query to update stock
	$stmt = $connection->prepare("SELECT jumlah FROM barang WHERE nama_brg = ?");
	$stmt->bind_param("s", $b);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$stok_awal = $row['jumlah'];
	$stok_akhir = $stok_awal + $d;

	$stmt = $connection->prepare("UPDATE barang SET jumlah = ? WHERE nama_brg = ?");
	$stmt->bind_param("is", $stok_akhir, $b);
	$stmt->execute();

?>
	<script type="text/javascript">
		window.location = 'index.php';
	</script>
<?php
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>