<?php
    require_once '../sql_login/login.php';
    $conn = mysqli_connect($hostname,$username,$password);

    if(!$conn)
        die("Connection failed : ".mysqli_connect_error());

    try{
        $drop_query = "DROP DATABASE {$database}";
        $res = mysqli_query($conn,$drop_query);
    }
    catch (Exception $exception){
        echo "The given database doens't exist. <br/>";
    }
    finally{
        $db_create = "CREATE DATABASE {$database}";
        if(mysqli_query($conn,$db_create))
            echo "Database created.</br>";
        else
            die("Error creating database.".mysqli_error($conn));

        mysqli_close($conn);

        $conn = mysqli_connect($hostname,$username,$password,$database);


        $table1 = "CREATE TABLE authenticate (username varchar(10) NOT NULL PRIMARY KEY, password varchar (15) NOT NULL, isAdmin BIT DEFAULT 0)";

        if(mysqli_query($conn,$table1))
            echo "Successfuly created authentication table. </br>";
        else
            die("Error while making authentication table.".mysqli_error($conn));

        // last column to check if user wants his/her email to be desplayed in the dashboard publically
        $table2 = "CREATE TABLE user_info (username varchar(10) NOT NULL PRIMARY KEY, email varchar(20), name varchar(20) NOT NULL, display_email BIT DEFAULT 1)";

        if(mysqli_query($conn,$table2))
            echo "Successfully created user_info table.<br/>";
        else
            die("Error creating user_info table.".mysqli_error($conn));


        // all questions added by this admin to be dispalyed using join-statements.
        $table3 = "CREATE TABLE admin_info (username varchar(10) NOT NULL PRIMARY KEY, email varchar(20), name varchar(20) NOT NULL,display_email BIT DEFAULT 1)";

        if(mysqli_query($conn,$table3))
            echo "Successfully created admin_info table.<br/>";
        else
            die("Error creating admin_info table.".mysqli_error($conn));


        // no need to store relative path of submitted sulutions by the user (due to directory structure)
        $table4 = "CREATE TABLE `q1` (
          `username` varchar(10) DEFAULT NULL,
          `status` varchar(10) DEFAULT NULL,
          `time_taken` float DEFAULT NULL,
          `link` varchar(255) DEFAULT NULL
        )";

        if(mysqli_query($conn,$table4))
            echo "Success Creating user_submissions table.<br/>";
        else
            die("Error creating user_submissions table.".mysqli_error($conn));

        // Table for each practice question to be created at the time of submission of question.
        // $table5 = "CREATE TABLE practice_ques ()";

        // test cases to be fetched dynamically (as path to testcases is fixed)
        $table6 = "CREATE TABLE practice_questions_info (ques_ID varchar(10) NOT NULL PRIMARY KEY,date_created date,successful_submissions integer(6) DEFAULT 0, total_submissions integer(6) DEFAULT 0 ,admin varchar(10) NOT NULL) ";
        if(mysqli_query($conn,$table6))
            echo "Success creating practice questions info table. <br/>";
        else
            die("Error creating practice questions info table.".mysqli_error($conn));

        $table7 = "CREATE TABLE all_contest_details (contest_ID varchar(10) NOT NULL PRIMARY KEY, contest_name varchar(30) NOT NULL, admin varchar(10) NOT NULL, date_created date, contest_length float DEFAULT 0.0) ";
        if(mysqli_query($conn, $table7))
            echo "Success creating table to store all contest details. <br/>";
        else
            die("Error creating table to store all contest details.<br>".mysqli_error($conn));

            $table8 = "CREATE TABLE `user` (
              `ques_id` varchar(20) DEFAULT NULL,
              `status` varchar(10) DEFAULT NULL,
              `time_taken` float DEFAULT NULL,
              `link` varchar(255) DEFAULT NULL
            ) ";
            if(mysqli_query($conn, $table8))
                echo "Success creating table to store all contest details. <br/>";
            else
                die("Error creating table to store all contest details.<br>".mysqli_error($conn));


                $table9 = "CREATE TABLE `user2` (
                  `ques_id` varchar(20) DEFAULT NULL,
                  `status` varchar(10) DEFAULT NULL,
                  `time_taken` float DEFAULT NULL,
                  `link` varchar(255) DEFAULT NULL
                ) ";
                if(mysqli_query($conn, $table9))
                    echo "Success creating table to store all contest details. <br/>";
                else
                    die("Error creating table to store all contest details.<br>".mysqli_error($conn));

        $query = "INSERT INTO `user_info` (`username`, `email`, `name`, `display_email`) VALUES
        ('user', 'yy@iitdh.ac', 'user', b'1'),
        ('user2', 'bb@yy.t', 'user2', b'1')";

        if(mysqli_query($conn, $query))
            echo "Success creating table to store all contest details. <br/>";
        else
            die("Error creating table to store all contest details.<br>".mysqli_error($conn));

        $query2 = "INSERT INTO `user` (`ques_id`, `status`, `time_taken`, `link`) VALUES
        ('q1', 'AC', 1, 'vvvbb')";

        if(mysqli_query($conn, $query2))
            echo "Success creating table to store all contest details. <br/>";
        else
            die("Error creating table to store all contest details.<br>".mysqli_error($conn));


        $query3 = "INSERT INTO `practice_questions_info` (`ques_ID`, `date_created`, `successful_submissions`, `total_submissions`, `admin`) VALUES
        ('q1', '2019-10-26', 0, 0, 'super')";

        if(mysqli_query($conn, $query3))
            echo "Success creating table to store all contest details. <br/>";
        else
            die("Error creating table to store all contest details.<br>".mysqli_error($conn));

        $query4 = "INSERT INTO `authenticate` (`username`, `password`, `isAdmin`) VALUES
        ('super', 'super', b'1'),
        ('user', 'user', b'0'),
        ('user2', 'user2', b'0')";


                if(mysqli_query($conn, $query4))
                    echo "Success creating table to store all contest details. <br/>";
                else
                    die("Error creating table to store all contest details.<br>".mysqli_error($conn));


        $query5 = "INSERT INTO `admin_info` (`username`, `email`, `name`, `display_email`) VALUES
        ('super', 'super@user.com', 'Thomas William', b'1')";

        if(mysqli_query($conn, $query5))
            echo "Success creating table to store all contest details. <br/>";
        else
            die("Error creating table to store all contest details.<br>".mysqli_error($conn));


    }

?>
