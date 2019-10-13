<?php 

require_once '../sql_login/login.php'	;

$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn) {
    die("Error occured while registration, please try again. <br>".mysqli_connect_error());
}


if(isset($_POST['register_uname']) && isset($_POST['register_pass']) && isset($_POST['register_name']) && isset($_POST['register_email']))
{
	$register_username = $_POST['register_uname'];
	$register_password = $_POST['register_pass'];
	$name = $_POST['register_name'];
	$email = $_POST['register_email'];

 }

 $query = "CREATE TABLE $register_username (ques_id varchar(255), status varchar(128), time_taken float, link varchar(255))";

 $result = mysqli_query($conn,$query);

if(!$result)
{
        header('Refresh:4; url=home.html');
        echo 'Username is not available. Try new Username.';
        exit();
}
else
{
	//Creating the directory to store the practice question solutions
	if(!file_exists("../solutions/$register_username"))
	{
		mkdir("../solutions/$register_username",0777,TRUE);
	}

	$new_query = "INSERT INTO user_info (username, email, name) VALUES (?,?,?)";
	prepared_query($conn,$new_query,[$register_username,$email,$name]);

	if(!$new_query)
	{
		die("Error in registration of $register_username<br>".mysqli_error($conn));
	}
	else
	{
		$newer_query = "INSERT INTO authenticate (username, password) VALUES (?,?)";
		prepared_query($conn,$newer_query,[$register_username,$register_password]);
		if(!$newer_query)
		{
			die("Error in registration of $register_username<br>".mysqli_error($conn));
		}
		else
		{
			header('Refresh:4; url=home.html');
			echo "<h1>Successfully Registered</h1>";
			exit();
		}
	}

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