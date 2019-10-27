<?php
session_start();

require_once "./../sql_login/login.php";
$conn = mysqli_connect($hostname,$username,$password,$database);
if (!$conn) {
    die('<p>Connection failed: <p>' . mysqli_connect_error());
}
if (!empty($_GET['user']) && !empty($_GET['pass'])) {
    $unsafename = $_GET['user'];
    $unsafepass = $_GET['pass'];
    $_SESSION['username'] = $unsafename;
    // reference for sql injection : https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    $query = $conn->prepare("SELECT * FROM {$userAuthenticationTable} WHERE username=? AND password=?");

    if ($query) {
        $query->bind_param('ss', $unsafename, $unsafepass);

        $query->execute();
        $result = $query->get_result();
        if(!$result) {
            header('Location: ./../home/home.php');
        }
        $num_rows = $result->num_rows;
        if (!$num_rows) {
            header('Location: ./../home/home.php');
        }
        else {
            $newRow = mysqli_fetch_row($result);

            if($newRow[2]==0) {
                header('Location: ./../user/dashboard.php');
            }
            else if($newRow[2]==1) {
                header('Location: ./../admin/admin_login.php');
            }
        }
    }
}
else {
    header('Location: ./../home/home.php');
}
?>
