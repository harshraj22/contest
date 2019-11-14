<?php
require_once './../sql_login/login.php' ;
session_start();
$conn = mysqli_connect($hostname,$username,$password,$database);
$userid = $_SESSION['username'];
$ques_id = $_GET['qid'];
// echo $userid;
echo $_POST['languages'];
if($_POST['languages'] == "")
{
    echo "      <script>
    alert('No language selected! Please go back');
    window.history.back();
    </script>";
    die();
}
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
    echo "There was some error in evaluating your solution.".mysqli_error($conn);
}
else
{
    file_put_contents($filename,$code);
    $query = "INSERT INTO $ques_id VALUES('$userid','$verdict','$time','$filename')";
    $result = mysqli_query($conn,$query);
    if(!$result)
    {
        echo "There was some error in inserting your solution".mysqli_error($conn);
    }
    else
    {
        $query = "SELECT * FROM practice_questions_info WHERE ques_id = '$ques_id'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        $submissions = $row['total_submissions'] + 1;
        $successful = $row['successful_submissions'];
        if($verdict == 'AC')
        {
            $successful = $successful + 1;
        }
        $query = "UPDATE practice_questions_info SET total_submissions = $submissions, successful_submissions = $successful WHERE ques_id = '$ques_id'";
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
            echo "COuldn't update practice questions info";
        }
        else
        {
            echo "<table><tr><th>#</th><th>Verdict</th><th>Time</th></tr><tr><td>1</td><td>".$verdict."</td><td>".$time."</td></tr></table>";
            echo "<a href=\"./../practice questions/display_question.php?ques_id=".$ques_id."\">Click Here to go back</a>";
        }
    }
}

