<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $qry = $result->fetch_assoc();
        $_SESSION['username'] = $qry['username'];
        $_SESSION['nama'] = $qry['nama'];
        $_SESSION['level'] = $qry['level'];

        if ($qry['level'] == "admin" || $qry['level'] == "user") {
            header("Location: ../template/index.php");
        }
    } else {
?>
        <script language="JavaScript">
            alert('Username atau Password tidak sesuai. Silahkan diulang kembali!');
            document.location = '../index.php';
        </script>
<?php
    }

    $stmt->close();
} else if ($op == "out") {
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    header("Location: ../index.php");
}

// Close the database connection
$connection->close();
?>