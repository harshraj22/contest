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
        if($_POST['user'] == "") {
            echo <<< _END
                <div>
                    <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
                </div>
_END;
                exit;
        }

    $currentUserId = trim($_POST['user']);
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
    //$pass_no = $_POST['test_no'];

    $row = mysqli_fetch_row($result);
    $currentUserName = $row[2];
    $currentUserEmail = $row[1];

?>

<! ------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <title>Add Contest</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
</head>
<body>
    <header>
        <p>
            <h1>Add Contest</h1>
        </p>

    </header>
    <nav>
            Navigation bar
    </nav>
    <div class="sline"></div>
    <div class="sline"></div>
    <section class="outer-section">
        <aside class="left-pane">
            <p>
                // Left Pane
                <div>
                    Id : <?php echo $currentUserId; ?>
                </div>
                    Email : <?php echo $currentUserEmail; ?>
                <div>
                    Name : <?php echo $currentUserName; ?>
                </div>
            </p>
        </aside>
        <section class="middle-pane">
            <p>
                <h2>Form to add contest</h2>
            </p>

            <div class="container">



                <form action = "update_contest.php" method = "post">
                    <ul class="add">
                    <li class="add">Title: <input type="text" name="title" required></li><br/>
                    <li class="add">contest Id: <input type="text" name="cont_id" required></li><br/><br/>
                    <li class="add">Total no. of questions in contest: <input type="number" name="ques" required></li><br/><br/>
                    <li class="add">Date<input type="date" name="date" required></li><br/>
                    <li class="add">Time Limit in minutes:<input type="number" min="0" step="0.5" name="time_limit" required></li><br/>
                    <li class="add">
                    Contest Description: <br/><br/>
                                      <textarea minlength=20 rows = "5" cols = "50" name = "description"></textarea><br/><br/>
                    </li>


                    <li class="add"><input type="submit" value="Go to add questions"/></button></li>
                    </ul>

                </form>
            </div>
        </section>

        <aside class="right-pane">
        </aside>

    </section>


    <footer>
        <p>This is the footer element.</p>
    </footer>


</body>
</html>
