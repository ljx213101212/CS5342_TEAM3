<?php
// echo chdir('/Users/jixiang/Documents/MATLAB/finalProject_demo');
// echo shell_exec('ls');
//echo shell_exec("matlab -nodesktop -nojvm -nosplash -r demo('123.jpg')");

// $command = "matlab -nodesktop -nojvm -nosplash -r demo";
// $res = exec($command, $output, $return);
// var_dump($res, $output, $return);
echo shell_exec('chmod 777 start.sh');
echo shell_exec('./start.sh test.jpg');
?>