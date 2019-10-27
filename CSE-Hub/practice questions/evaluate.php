<?php
    $output = shell_exec("bash ./ex.sh new.py 3");
    // exec(" sudo -S /home/harsh/Desktop/Lamp/apache2/htdocs/try/try/ex.sh new.cpp 1",$output,$return);
    print_r($output);
    print_r($return);

?>