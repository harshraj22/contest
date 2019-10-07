<?php
    session_start();
    require_once '../sql_login/login.php';

    // in case the user directly want's to access this page, php doesn't know whose profile to display
    if(!isset($_GET['user'])){
        echo <<< _END
            <div>
                <h1>Error 4040 <br> <h3>The page you requested doesn't exists.</h3></h1>
            </div>
_END;
        exit;
    }

    $currentUserId = trim($_GET['user']);

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
                <form action = "update.php" method = "post">
                    <ul class="add">
                    <li class="add">Title: <input type="text" name="title"></li><br/>
                    <li class="add">Question Id: <input type="text" name="ques_id"></li><br/><br/>
                    <li class="add">
                    Question Description: <br/><br/>
                                      <textarea rows = "5" cols = "50" name = "description">
                                  </textarea><br/><br/>
                    </li>
                    <li class="add">
                    testcase: <br/>
                                      <textarea minlength=20 rows = "5" cols = "50" name = "testcase">
                                  </textarea><br/><br/>
                    </li>
                    <li class="add">
                    solution: <br/>
                                      <textarea rows = "5" cols = "50" name = "solution">
                                      </textarea><br/><br/>
                    </li>
                    <li class="add">Date<input type="date" name="date"></li><br/>
                    <li class="add">Time Limit in seconds:<input type="number" name="time_limit"></li><br/>
                    <li class="add"><input type="submit" value="Add"/></button></li>
                    </ul>

                    <?php
                    echo <<<_END
                    <input type="hidden" name="btn1" value="$currentUserId"/></button>
_END;
                    ?>

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
