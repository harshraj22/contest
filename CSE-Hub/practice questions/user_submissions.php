<?php
    require_once '../sql_login/login.php';
    // if page is requested without giving username
    if(!isset($_GET['user']))
        die("The page you requested doesn't exists.");

    $conn = mysqli_connect($hostname,$username,$password,$database);
    
    if(!$conn)
        die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());

    $query = "SELECT * FROM {$_GET['user']}";

    $result = mysqli_query($conn,$query);
    if(!$result)
        die("Error fetching user submissions details.".mysqli_error($conn));
    
    // print_r($result);
    $num_of_rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user submissions</title>
</head>
<body>
    <!-- (ques_id varchar(255), status varchar(128), time_taken float, link varchar(255)) -->
    <table>
        <tr>
            <th>
                Question Id
            </th>
            <th>
                Status
            </th>
            <th>
                Time 
            </th>
        </tr>

        <?php

            for($i=0;$i<$num_of_rows;$i++){
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                    echo "<th><a href='{$row[3]}' >{$row[0]}</a></th>";
                    echo "<th>{$row[1]}</th>";
                    echo "<th>{$row[2]}</th>";

                echo "</tr>";
            }

        ?>
    </table>    


</body>
</html>