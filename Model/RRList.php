<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 1:41 AM
 */

class RRList{


    /* Member variables */
    var $items = array();

    /* Member functions */

    function get_items_arr(){
        return $this->items;
    }


    function insert_items($items){
        array_push($this->items,$items);
    }

}

?>