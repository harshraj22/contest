<?php
ini_set("display error",1);

if(!isset($_GET['ques_id'])){
    echo <<< _END
        <div>
            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
        </div>
_END;
    exit;
}

$ques_id = trim($_GET['ques_id']);
$name = $ques_id.".txt";

$content = fopen("all questions/$ques_id/$name", "r");
$content = fread($content, 25000);
if($content==""){
    echo <<< _END
        <div>
            <h1>Error 404 <br> <h3>The page you requested doesn't exists.</h3></h1>
        </div>
_END;
    exit;
}
?>

<!-------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
    <title>Question Page</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">
</head>
<body>
    <header>
        <p>
            <h1>Question Page</h1>
        </p>
    </header>
    <nav>
            Navigation bar
    </nav>
    <div class="sline"></div>
    <div class="sline"></div>
    <section class="outer-section">

        <section class="middle-pane">

            <div class="title">
                <h1 class="ques_id"><?php echo $ques_id; ?></h1>
            </div>
            <div class="submit_top">
                <form action="submissions.php" method="POST">
                <input type="hidden" value="<?php echo $ques_id; ?>" name="qid">
                    <input type="submit" value="Submit Code">
                </form>
            </div>
            <div class="container">
                <?php echo nl2br($content); ?>
            </div>
            <div class="submit_bottom">
                <form action="submissions.php" method="POST">
                <input type="hidden" value="<?php echo $ques_id; ?>" name="qid">
                    <input type="submit" value="Submit Code">
                </form>
            </div>

        </section>

        <aside class="right-pane">
            right pane
        </aside>

    </section>

    <div class="below">
    <footer>
        <p>This is the footer element.</p>
    </footer>
    </div>

</body>
</html>
