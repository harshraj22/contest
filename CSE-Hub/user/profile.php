<?php
session_start();
require_once '../sql_login/login.php';

// in case the user directly want's to access this page, php doesn't know whose profile to display
if(!isset($_GET['username'])){
    echo <<< _END
        <div>
            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
        </div>
_END;
    exit;
}

$currentUserId = trim($_GET['username']);

$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn)
    die("Error while fetching data. Please try after sometimes. <br>".mysqli_connect_error());

$query = "SELECT * FROM user_info WHERE username='{$currentUserId}'";
$result = mysqli_query($conn,$query);

if(!$result)
    die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
else if(mysqli_num_rows($result) == 0){
    $noUserMessage = "<div> No user {$currentUserId} Exists.<br/> </div>";
    die($noUserMessage);
}

$row = mysqli_fetch_row($result);


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
</head>
<body>
    <header>
        <p>
            <h1>User Profile</h1>
        </p>

    </header>
    <nav>
            Navigation bar
    </nav>
    <div class="sline"></div>
    <div class="sline"></div>
    <section class="outer-section">
        <aside class="left-pane">
            <p>Edit profile
                <form action="edit_profile.php" method="GET">
                    <button type="submit">edit</button>
                </form>
            </p>
        </aside>
        <section class="profile-middle-pane">
            <br/>
            <br/>
            Username:<?php echo " ".$currentUserId; ?>
            <br/>
            <div class="sline"></div>
            <br/>
            Name:<?php echo " ".$row[2]; ?>
            <br/>
            <div class="sline"></div>
            <br/>
            Email:<?php echo " ".$row[1]; ?>
            <br/>
            <div class="sline"></div>
            <br/>
            submissions
            <br/>
            pi chart of Submissions
            and... space to represent other user stats
        </section>
    </section>

    <footer>
        <p>This is the footer element.</p>
    </footer>
</body>
</html>
