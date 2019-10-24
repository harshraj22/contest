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
$query_wa = "SELECT COUNT(result) FROM user_submissions WHERE result LIKE 'WA'";
$query_ac = "SELECT COUNT(result) FROM user_submissions WHERE result LIKE 'AC'";
$query_tle = "SELECT COUNT(result) FROM user_submissions WHERE result LIKE 'TLE'";
$query_pa = "SELECT COUNT(result) FROM user_submissions WHERE result LIKE 'PA'";
$query_re = "SELECT COUNT(result) FROM user_submissions WHERE result LIKE 'RE'";
$result = mysqli_query($conn,$query);
$result_wa = mysqli_query($conn,$query_wa);
$result_ac = mysqli_query($conn,$query_ac);
$result_tle = mysqli_query($conn,$query_tle);
$result_pa = mysqli_query($conn,$query_pa);
$result_re = mysqli_query($conn,$query_re);

if(!$result)
    die("Error fetching details of {$currentUserId}<br>".mysqli_error($conn));
else if(mysqli_num_rows($result) == 0){
    $noUserMessage = "<div> No user {$currentUserId} Exists.<br/> </div>";
    die($noUserMessage);
}

if(!$result_wa || !$result_ac || !$result_tle || !$result_pa || !$result_re)
    die("Error <br>".mysqli_error($conn));
else if(mysqli_num_rows($result) == 0){
    $noUserMessage = "<div> error<br/> </div>";
    die($noUserMessage);
}

$row = mysqli_fetch_row($result);
$wa = mysqli_fetch_row($result_wa);
$ac = mysqli_fetch_row($result_ac);
$tle = mysqli_fetch_row($result_tle);
$pa = mysqli_fetch_row($result_pa);
$re = mysqli_fetch_row($result_re);

//echo $wa[0];
//echo $ac[0];
//echo $tle[0];
//echo $pa[0];
//echo $re[0];

$php_data_array = Array();
$php_data_array[0][0]="wa";
$php_data_array[0][1]=$wa[0];
$php_data_array[1][0]="ac";
$php_data_array[1][1]=$ac[0];
$php_data_array[2][0]="tla";
$php_data_array[2][1]=$tle[0];
$php_data_array[3][0]="pa";
$php_data_array[3][1]=$pa[0];
$php_data_array[3][0]="re";
$php_data_array[3][1]=$re[0];

echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
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
            <div id="chart_div"></div>
            <br><br>
        </section>
    </section>

    <footer>
        <p>This is the footer element.</p>
    </footer>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.anychart.com/js/8.0.1/anychart-core.min.js"></script>
<script>
google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(draw_my_chart);
    function draw_my_chart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'language');
        data.addColumn('number', 'Nos');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
    var options = {title:'stats',
                       width:600,
                       height:500};
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    }
</script>
</html>
