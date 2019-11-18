<?php

//ini_set("display error",1);
session_start();
require_once '../sql_login/login.php';

// in case the user directly want's to access this page, php doesn't know whose profile to display
if(!isset($_POST['user']) && !isset($_SESSION['user'])){
    echo <<< _END
        <div>
            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
        </div>
_END;
        exit;
    }
require_once '../sql_login/login.php';
//echo $_SESSION['contest_id'];
$contest_id = $_SESSION['contest_id'];
$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn) {
    die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());
}

if($_POST['title'] !== ""  && $_POST['ques_id'] !=="" && !trim($_POST['description']) == "" && $_POST['time_limit'] !== "" && $_POST['date'] !== "") {

    $username = $_POST['btn1'];
    $ques_id = trim($_POST['ques_id']);
    $date = $_POST['date'];
    $description = $_POST["description"];

    $hide_test = $ques_id . "test";
    $query = "CREATE TABLE $hide_test (
              serial_no INT,
              test varchar(255)
              )";

    $result = mysqli_query($conn, $query);

    $hide_subm = $ques_id . "solution";
    $query = "CREATE TABLE $hide_subm (
              serial_no INT,
              test varchar(255)
              )";

    $result = mysqli_query($conn, $query);

    if(!$result) {
        header('Refresh:4; url=add_contest_question.php');
        echo 'Question Id is not available. Try new Id.';
        exit();
    }

   mkdir("$contest_id/$ques_id",0777,TRUE);
   for($x=0;$x<$_POST['test_no'];$x++) {
       $testcase = $_POST["testcase$x"];
       $solution = $_POST["solution$x"];


       $newquery = 'INSERT INTO ' .$hide_test. ' (serial_no, test) VALUES (?,?)';
       $stmt = prepared_query($conn, $newquery, [$x, $testcase]);
       //$stmtt = mysqli_query($conn, $newquery);
       if(!$stmt)
           die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
       else {

           echo 'successfuly added your question';

       }

       $newquery = 'INSERT INTO ' .$hide_subm. ' (serial_no, test) VALUES (?,?)';
       $stmt = prepared_query($conn, $newquery, [$x, $solution]);
       //$stmtt = mysqli_query($conn, $newquery);
       if(!$stmt)
           die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
       else {

           echo 'successfuly added your question';

       }

       //creating directories for description and testcases
       /*if( !file_exists("$contest_id/$ques_id") ) {
        mkdir("$contest_id/$ques_id/solutions",0777,TRUE);
        mkdir("$contest_id/$ques_id/testcases",0777,TRUE);
        }

        $y = $x+1;

        file_put_contents("$contest_id/$ques_id/solutions/sol$y.txt", $solution);
        file_put_contents("$contest_id/$ques_id/testcases/test$y.txt", $testcase);
        */
   }

    $query = "CREATE TABLE $ques_id (
              username varchar(255),
              status varchar(128),
              time_taken float,
              lang varchar(10)
              )";

    $result = mysqli_query($conn, $query);

    if(!$result) {
        header('Refresh:4; url=question_update.php');
        echo 'Question Id is not available. Try new Id.';
        exit();
    }

    $name = $ques_id.".txt";

    if( !file_exists("$contest_id/$ques_id") ) {
     mkdir("$contest_id/$ques_id",0777,TRUE);
    }

    //adding description, testcases and solution text into files
    file_put_contents("$contest_id/$ques_id/$name", $description);

    // updating practice_question_info table
    $newquery = 'INSERT INTO ' .$contest_id. ' (ques_id, total_submissions) VALUES (?,"0")';
    $stmt = prepared_query($conn, $newquery, [$ques_id]);
    //$stmtt = mysqli_query($conn, $newquery);
    if(!$stmt)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else {
        header('Refresh:4; url=add_contest_question.php');
        echo 'successfuly added your question';
        exit();
    }
}
else {
    header('Refresh:50; url=add_contest_question.php');
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

session_destroy();
?>
