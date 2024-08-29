<!doctype html>
<html>

<head>
    <title>Pagination with Bootstrap 3 - harviacode.com</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS */
        .pagination,
        .pager {
            margin-top: 0px;
        }

        .table {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Form Tambah Data Barang Masuk</h3>
        <form method="post" action="simpan_barang_masuk.php">
            <table class="table table-bordered">
                <tr>
                    <td>No Transaksi</td>
                    <td><input class="form-control" type="text" name="no" required></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>
                        <?php
                        include "koneksi.php";

                        // Create a connection to the MySQL database
                        $connection = new mysqli("localhost", "root", "", "toko");

                        // Check if the connection was successful
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        // Fetch data from 'barang' table
                        $query = "SELECT nama_brg FROM barang";
                        $result = $connection->query($query);

                        if ($result->num_rows > 0) {
                            echo "<select name='nama' class='form-control'>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<option>{$row['nama_brg']}</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<p>No data available</p>";
                        }

                        $connection->close();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Harga Satuan</td>
                    <td><input class="form-control" type="text" name="harga" required></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><input class="form-control" type="text" name="jumlah" required></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><input class="form-control" type="text" name="total" required></td>
                </tr>
                <tr>
                    <td><input type="submit" class="btn btn-primary" value="Simpan"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>