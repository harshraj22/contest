<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    require_once '../sql_login/login.php';

    // in case the user directly want's to access this page, php doesn't know whose profile to display

    if(!isset($_SESSION['username'])){
        //echo $_SESSION['username'];
        //echo session_id();
        echo <<< _END
            <div>
                <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
            </div>
_END;
        exit;
    }

    $currentUserId = trim($_SESSION['username']);

    $conn = mysqli_connect($hostname,$username,$password,$database);

    if(!$conn)
        die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());

    $query = "SELECT * FROM user_info WHERE username='{$currentUserId}'";

    // for now we display only 10 questions
    $order = '';
    if(isset($_GET['sortBy'])){
        $sort = ' ORDER BY '.trim($_GET['sortBy']);
        if(isset($_GET['order']) && $_GET['order']==1)
            $order = ' DESC ';
    }
    else
        $sort = '';
    $newQuery = "SELECT * FROM practice_questions_info ". $sort . $order." LIMIT 10";

    // echo $newQuery;

    $result = mysqli_query($conn,$query);
    $newResult = mysqli_query($conn,$newQuery);

    $newNumOfRows = mysqli_num_rows($newResult);

    if(!$result)
        die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
    else if(mysqli_num_rows($result) == 0){
        $noUserMessage = "<div> No user {$currentUserId} Exists.<br/> </div>";
        die($noUserMessage);
    }

    $row = mysqli_fetch_row($result);

    $currentUserName = $row[2];
    $currentUserEmail = $row[1];

?>

<!-- -------------------------------------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
</head>
<body>
    <header>
        <p>
            <h1>Welcome User</h1>
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
                Main Content
                // ADD User Stats Here.
                <?php
                echo <<< _END
                <form action="profile.php" method="GET">
                    <button type="submit" name="username" value="$currentUserId">Profile</button>
                </form>
_END;
                ?>
            </p>
        </section>
        <aside class="right-pane">
            <p>
                Right Pane<br>
                <table>
                    <tr>
                        <th>
                            <a href='../practice questions/all_questions.php'>All questions</a>
                            <a href='../practice questions/user_submissions.php?user=<?php echo $currentUserId; ?>'>Submissions</a>
                        </tr>
                    </tr>
                </table>
                <table>
                    <!-- <?php
                        $_GET['user'] = $currentUserId;
                    ?> -->
                    <tr>
                        <th>
                            Problem
                        </th>
                        <th>
                            <form type="GET" name="submissions">
                                <a href='dashboard.php?user=<?php echo $currentUserId; ?>&&sortBy=successful_submissions'>Successful Submissions</a>
                            </form>
                        </th>
                        <th>
                            <form type="GET" name="date_">
                                <a href='dashboard.php?user=<?php echo $currentUserId; ?>&&sortBy=date_created'>Date Created</a>
                            </form>
                        </th>
                    </tr>
                    <?php

                        for($i = 0;$i<$newNumOfRows;$i++){
                            $newRow = mysqli_fetch_row($newResult);
                            $file = $newRow[0].".txt";

                            echo <<< _END
                                <tr>
                                    <th>
                                    <form action="../practice questions/display_question.php" method="GET">
                                        <input type="hidden" name="ques_id" value=$newRow[0]>
                                        <button type="submit">$newRow[0]</button>
                                    </form>
                                    </th>
                                    <th>
                                        {$newRow[2]}
                                    </th>
                                    <th>
                                        {$newRow[1]}
                                    </th>
                                </tr>
_END;


                        }
                        // echo "volla<br>";
                    ?>
                </table>

            </p>
        </aside>
    </section>
    <footer>
        <p>This is the footer element.</p>
    </footer>
</body>
</html>
