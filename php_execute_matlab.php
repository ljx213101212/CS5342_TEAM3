<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 10/4/16
 * Time: 5:07 PM
 */

function exe_matlab($matlab_method_name)
{
    //Give shell script highest privilege.
    shell_exec('chmod 777 start.sh');
    //run matlab code
    shell_exec('./start.sh ' . $matlab_method_name);
}


?>