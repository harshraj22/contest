<?php

//ini_set("display error",1);

require_once '../sql_login/login.php';

$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn) {
    die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());
}




if($_POST['title'] !== ""  && $_POST['ques_id'] !=="" && !trim($_POST['description']) == "" && !trim($_POST['testcase']) == "" && !trim($_POST['solution']) == "" && $_POST['time_limit'] !== "" && $_POST['date'] !== ""){

    $username = $_POST['btn1'];
    $ques_id = trim($_POST['ques_id']);
    $date = $_POST['date'];
    $description = $_POST["description"];
    $testcase = $_POST["testcase"];
    $solution = $_POST['solution'];

    $query = "CREATE TABLE $ques_id (
              username varchar(255),
              status varchar(128),
              time_taken float,
              link varchar(255)
              )";

    $result = mysqli_query($conn, $query);

    if(!$result) {
        header('Refresh:4; url=admin_login.php');
        echo 'Question Id is not available. Try new Id.';
        exit();
    }

    $name = $ques_id.".txt";

    //creating directories for description and testcases
    if( !file_exists("../practice questions/all testcases/$ques_id") )
    {
     mkdir("../practice questions/all testcases/$ques_id/solutions",0777,TRUE);
     mkdir("../practice questions/all testcases/$ques_id/testcases",0777,TRUE);
    }
    if( !file_exists("../practice questions/all questions/$ques_id") )
    {
     mkdir("../practice questions/all questions/$ques_id",0777,TRUE);
    }

    //adding description, testcases and solution text into files
    file_put_contents("../practice questions/all questions/$ques_id/$name", $description);
    file_put_contents("../practice questions/all testcases/$ques_id/solutions/sol.txt", $solution);
    file_put_contents("../practice questions/all testcases/$ques_id/testcases/test.txt", $testcase);

    // updating practice_question_info table
    $newquery = 'INSERT INTO practice_questions_info (ques_ID, date_created, successful_submissions, total_submissions, admin) VALUES (?, ?, "0", "0", ?)';
    prepared_query($conn, $newquery, [$ques_id, $date, $username]);

    if(!$newquery)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else {
        header('Refresh:4; url=admin_login.php');
        echo 'successfuly added your question';
        exit();
    }
}
else {
    header('Refresh:50; url=admin_login.php');
    echo 'Please fill all details';
    exit();
}

function prepared_query($mysqli, $sql, $params, $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}

?>
