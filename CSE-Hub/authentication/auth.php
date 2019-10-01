<?php

require_once "./../sql_login/login.php";
$conn = mysqli_connect($hostname,$username,$password,$database);

if (!$conn) {
    die('<p>Connection failed: <p>' . mysqli_connect_error());
}
if (!empty($_POST['name']) && !empty($_POST['pass'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM {$table} WHERE {$userIds}='{$name}' AND {$userPasswords}='{$pass}'";
    $result = mysqli_query($conn,$query);
    $num_rows = mysqli_num_rows($result);
    if (!$num_rows) {
        header('Location: ./../home/home.html');
    }
    else {
        header('Location: ./../user/dashboard.html');
    }
}
else {
    header('Location: ./../home/home.html');
}
?>