<?php
session_start();

echo <<<_END
<html lang="en">

    <head>
        <title>CSE-Hub &mdash; IIT Dharwad</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
    </head>

    <body>
        <header>
            <div class="login_bar">
                <form action="./../authentication/auth.php" method="get">
                    <ul>
                        <li><input class="text-fields" type="text" name="user" placeholder="Username" required/> </li>
                        <li><input class="text-fields" type="password" name="pass" placeholder="Password" required/></li>
                        <li><input type="submit" class="submit-button" name="in" value="Login" /></li>
                    </ul>
                </form>
            </div>
            <div class="site_name">
                <h1>CSE-Hub</h1>
            </div>
        </header>

        <div class="sline"></div>
        <div class="sline"></div>

        <section class="main-section">
    		<section class="main-pane">
    			<p>
    				Main Content
    			</p>
    		</section>
    		<aside class="right-pane">
    			<p>
    				Register yourself here. It's Free!
                    <br/><br/>
                    <form action="signup.php" method="post">
                        <ul>
                            <li><input class="text-fields" type="text" name="register_uname" placeholder="Username"/> </li><br/>
                            <li><input class="text-fields" type="password" name="register_pass" placeholder="Password"/></li><br/>
                            <li><input class="text-fields" type="text" name="register_name" placeholder="Name"/></li><br/>
                            <li><input class="text-fields" type="email" name="register_email" placeholder="Email"/></li><br/>
                            <li><input type="submit" class="submit-button" name="register_in" value="Register" /></li><br/>
                        </ul>
                    </form>
    			</p>
    		</aside>
    	</section>

        <footer>
            <div class="footer">
                <br/>
                <br/>
                CSE-Hub is contest hosting website
            </div>
        </footer>
    </body>

</html>
_END;
?>
