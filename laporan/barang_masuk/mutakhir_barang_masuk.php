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
    <center>
        <?php
        $kiriman = $_GET['data'];

        include "koneksi.php";

        // Create a connection to the MySQL database
        $connection = new mysqli("localhost", "root", "", "toko");

        // Check if the connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare and execute the SQL query to fetch data
        $stmt = $connection->prepare("SELECT * FROM barang_masuk WHERE no_trx = ?");
        $stmt->bind_param("s", $kiriman);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data_barang = $result->fetch_assoc();
        } else {
            echo "No data found";
            exit();
        }

        // Fetching barang for the select dropdown
        $barang_result = $connection->query("SELECT nama_brg FROM barang");

        echo "
        <br/><br/><br/><br/>
        <form action='simpan_mutakhir_barang_masuk.php' method='post'>
            <table class='table table-bordered' style='font-family:sans-serif;'>
                <tr>
                    <td>No Transaksi</td>
                    <td><input class='form-control' type='text' name='no' value='" . htmlspecialchars($data_barang['no_trx']) . "'></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>
                        <select name='nama' class='form-control'>
            ";

        // Populate the dropdown options
        while ($row = $barang_result->fetch_assoc()) {
            $selected = ($row['nama_brg'] === $data_barang['nama_brg']) ? "selected" : "";
            echo "<option value='" . htmlspecialchars($row['nama_brg']) . "' $selected>" . htmlspecialchars($row['nama_brg']) . "</option>";
        }

        echo "
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Harga Satuan</td>
                    <td><input class='form-control' type='text' name='harga' value='" . htmlspecialchars($data_barang['harga']) . "'></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><input class='form-control' type='text' name='jumlah' value='" . htmlspecialchars($data_barang['jumlah']) . "'></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><input class='form-control' type='text' name='total' value='" . htmlspecialchars($data_barang['total']) . "'></td>
                </tr>
                <tr>
                    <td><input type='submit' class='btn btn-primary' value='Simpan Mutakhir'></td>
                    <td><a href='index.php'><input class='btn btn-primary' type='button' value='Batal'></a></td>
                </tr>
            </table>
        </form>
        ";

        // Close the statement and connection
        $stmt->close();
        $connection->close();
        ?>
    </center>
</body>

</html>