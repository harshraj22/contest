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

    $query = "SELECT * FROM user_info WHERE username='{$currentUserId}'";

    $result = mysqli_query($conn, $query);

    if(!$result)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else if(mysqli_num_rows($result) == 0) {
        $noUserMessage = "<div> No admin {$currentUserId} Exists.<br/> </div>";
        die($noUserMessage);
    }

    $currentUserId = $_SESSION['user'] ;
    $pass_no = $_POST['test_no'];

    $row = mysqli_fetch_row($result);
    $currentUserName = $row[2];
    $currentUserEmail = $row[1];

?>

<! ------------------------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <title>Add Practice Question</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
</head>
<body>
    <header>
        <p>
            <h1>Add Question</h1>
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
                <h2>Form to add question</h2>
            </p>

            <div class="container">

                <form action = "add_question.php" method = "post">
                type total number of testcases you want to add for the question and click go.
                    <?php
                    echo <<<_END
                    <input type="number" min="1" step="1" name="test_no" value="go"/>
                    <input type="submit" name="btn2" value="go"/></button>
                    <input type="hidden" name="user" value="$currentUserId"/>
_END;
                    ?>
                </form>

                <form action = "update.php" method = "post">
                    <ul class="add">
                    <li class="add">Title: <input type="text" name="title" required></li><br/>
                    <li class="add">Question Id: <input type="text" name="ques_id" required></li><br/><br/>
                    <li class="add">Date<input type="date" name="date" required></li><br/>
                    <li class="add">Time Limit in seconds:<input type="number" min="0" step="0.5" name="time_limit" required></li><br/>
                    <li class="add">
                    Question Description: <br/><br/>
                                      <textarea minlength=20 rows = "5" cols = "50" name = "description"></textarea><br/><br/>
                    </li>

                    <?php

                    echo<<< _END

                    <input type="hidden" name="btn1" value="$currentUserId"/></button>
                    <input type="hidden" name="test_no" value="$pass_no"/>

_END;
                    //$_SESSION['test_no'] = $_POST['test_no'];
                    for($x = 0; $x<$_POST['test_no']; $x++) {
                        echo <<<_END

                        <li class="add">
                        testcase1: <br/>
                                          <textarea rows = "3" cols = "50" name = "testcase$x"></textarea><br/><br/>
                        </li>
                        <li class="add">
                        solution1: <br/>
                                          <textarea rows = "3" cols = "50" name = "solution$x"></textarea><br/><br/>
                        </li>

_END;
                    }

                    ?>
                    <li class="add"><input type="submit" value="Add"/></button></li>
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
