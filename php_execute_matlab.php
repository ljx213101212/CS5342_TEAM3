<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 10/4/16
 * Time: 5:07 PM
 */

function exe_matlab($matlab_method_name)
{

    shell_exec('chmod 777 start2.sh');
    shell_exec('./start2.sh ' . $matlab_method_name);
}


?>