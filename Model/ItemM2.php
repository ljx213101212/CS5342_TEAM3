<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 1:30 AM
 */


class ItemM2 extends Item{

    var $reflection_img;
    var $background_img;


    function get_reflection_img_name(){
        return $this->reflection_img;
    }

    function get_background_img_name(){
        return $this->background_img;
    }
}

?>