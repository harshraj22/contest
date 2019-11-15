<?php
$ques_id = $_POST['qid'];
if(!isset($_POST['qid']))
{
    echo "      <script>
    alert('No question selected! Please go back');
    window.location.href='./all_questions.php';
    </script>";
}
session_start();
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <h1><?php echo $ques_id; echo "<br>".$_SESSION['username'];?> </h1>
<form action="./../practice questions/submit.php?qid=<?php echo $ques_id ?>" method="POST">
    Select Language: &emsp;
    <input list="language-list" id="languages" name="languages" />

    <datalist id="language-list" name="languages">
        <option value="C"></option>
        <option value="C++"></option>
        <option value="Python3"></option>

    </datalist>
    <br><br>
    <textarea name="code" rows="30" cols="100">Enter Your Code here</textarea>
    <br>
    <input type="submit" value="Submit Code">
</form>
</body>

</html>