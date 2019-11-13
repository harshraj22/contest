<?php
require_once './../sql_login/login.php' ;
session_start();
$conn = mysqli_connect($hostname,$username,$password,$database);
$userid = $_SESSION['username'];
$ques_id = $_GET['qid'];
// echo $userid;
if(!$conn)
{
    echo "DB connection error";
}
$search = $ques_id.'%';
// echo $search;
$query = "SELECT * FROM $userid WHERE ques_id LIKE '$search'";
$result = mysqli_query($conn,$query);
$app = 0;
$code = $_POST['code'];
if(!$result)
{
    printf("Error: %s\n", mysqli_error($conn));
}
else
{
    while($row = mysqli_fetch_array($result))
    {
        $app = substr($row['ques_id'],strlen($ques_id));
    }
}
$app = $app + 1;
// $app = $app + "";
$entry = $ques_id.$app;
$filename = "./../solutions/$userid/$entry";
$verdict = "AC"; //Insert actual verdict here after evaluation
$time = 1; //Insert actual time after eval here
$query = "INSERT INTO $userid VALUES('$entry','$verdict',$time,'./../solutions/$userid/$ques_id/$entry')";
$result = mysqli_query($conn,$query);
if(!$result)
{
    echo "There was some error in inserting your solution.".mysqli_error($conn);
}
else
{
    file_put_contents($filename,$code);
    echo "Successfully inserted.<br>";
    echo "<a href=\"./../user/dashboard.php\">Click Here to go back</a>";
}

