<?php
    session_start();
    require_once '../sql_login/login.php';

    // in case the user directly want's to access this page, php doesn't know whose profile to display
    if(!isset($_POST['user'])){
        echo <<< _END
            <div>
                <h1>Error 4040 <br> <h3>The page you requested doesn't exists.</h3></h1>
            </div>
        _END;
        exit;
    }

    $currentUserId = trim($_POST['user']);

    $conn = mysqli_connect($hostname,$username,$password,$database);
    
    if(!$conn)
        die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());

    $query = "SELECT * FROM user_info WHERE username='{$currentUserId}'";
    $newQuery = "SELECT * FROM practice_questions_info LIMIT 10";

    // echo $query;

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
    $newRow = mysqli_fetch_row($newResult);
    $currentUserName = $row[2];
    $currentUserEmail = $row[1];

?>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

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

            </p>
        </section>
        <aside class="right-pane">
            <p>
                Right Pane<br>
                <table>
                    <tr>
                        <th>
                            Problem
                        </th>
                        <th>
                            Successful Submission
                        </th>
                        <th>
                            Date Created     
                        </th>
                    </tr>
                    <?php
                        
                        for($i = 0;$i<$newNumOfRows;$i++){
                            $file = $newRow[0].".txt";

                            echo <<< _END
                                <tr>
                                    <th>
                                        <a href='../practice_questions/all_questions/{$newRow[0]}/{$file}'>{$newRow[0]}</a>
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
                        echo "volla<br>";
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