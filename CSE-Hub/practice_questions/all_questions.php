<?php
    require_once '../sql_login/login.php';

    $conn = mysqli_connect($hostname,$username,$password,$database);
    if(!$conn)
        die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());
    $query = "SELECT * FROM practice_questions_info";
    $result = mysqli_query($conn,$query);

    if(!$result)
        die("Error fetching all questions.".mysqli_error($conn));
    
    $num_of_rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Questions</title>
</head>
<body>
    <table>
        <tr>
            <th>
                Question Id
            </th>
            <th>
                Title
            </th>
            <th>
                Successful Submissions
            </th>
            <th>
                Date
            </th>
        </tr>

        <?php

            for($i=0;$i<$num_of_rows;$i++){
                $row = mysqli_fetch_row($result);
                echo "<tr>";
                    echo "<th>".$row[0]."</th>";
                    echo "<th>"."title to be inserted"."</th>";
                    echo "<th>".$row[2]."</th>";
                    echo "<th>".$row[1]."</th>";

                echo "</tr>";
            }

        ?>
    </table>

</body>
</html>