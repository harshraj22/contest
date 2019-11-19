<?php
    //ini_set ("display error", 1);

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


    $currentUserId = $_SESSION['user'];
    $_SESSION['user'] = $currentUserId;


    $conn = mysqli_connect($hostname,$username,$password,$database);

    if(!$conn) {
        die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());
    }

    $query = "SELECT * FROM admin_info WHERE username='{$currentUserId}'";

    $result = mysqli_query($conn, $query);

    if(!$result)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else if(mysqli_num_rows($result) == 0) {
        $noUserMessage = "<div> No admin {$currentUserId} Exists.<br/> </div>";
        die($noUserMessage);
    }

    $currentUserId = $_SESSION['user'] ;

    $row = mysqli_fetch_row($result);
    $currentUserName = $row[2];
    $currentUserEmail = $row[1];

    $contest_title = $_POST['title'];
    //echo $contest_title;
    $contest_id = $_POST['cont_id'];
    //echo $contest_id;
    $_SESSION['contest_id'] = $contest_id;
    $questions_no = $_POST['ques'];
    //echo $questions_no;
    $date = $_POST['date'];
    //echo $date;
    $time = $_POST['time_limit'];
    //echo $time;
    $desc = $_POST['description'];
    //echo $desc;

    $query = "CREATE TABLE `$contest_id` (
    `ques_id` varchar(10) NOT NULL,
    `total_submissions` INT(20) DEFAULT NULL
    )";

    $result = mysqli_query($conn, $query);

    if(!$result)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else {
        echo "successfuly created table\n";
    }

    $user_table = $contest_id . "users";

    $query = "CREATE TABLE `$user_table` (
    `user_id` varchar(10) NOT NULL,
    `ques_id` varchar(10) NOT NULL,
    `total_submissions` INT(20) DEFAULT NULL
    )";

    $result = mysqli_query($conn, $query);

    if(!$result)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else {
        echo "successfuly created table";
    }

    mkdir("../contest/$contest_id",0777,TRUE);
    //mkdir("../contest/$contest_id/all_questions",0777,TRUE);
    mkdir("../contest/$contest_id/submissions",0777,TRUE);

    $newquery = 'INSERT INTO all_contest_details (contest_ID, contest_name, admin, date_created, contest_length) VALUES (?, ?, ?, ?, ?)';
    $stmt = prepared_query($conn, $newquery, [$contest_id, $contest_title, $currentUserId, $date, $time]);

    if(!$stmt)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else {
        header('Refresh:4; url=add_contest_question.php');
        echo 'successfuly added your question';
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
