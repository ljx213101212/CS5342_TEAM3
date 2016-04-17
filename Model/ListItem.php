<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 1:23 AM
 */


class ListItem{


    /* Member variables */
    var $folder_name;
    var $item;

    /* Member functions */

    function get_log_name(){
        return $this->folder_name;
    }

    function  get_item(){
        return $this->item;
    }
}