<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 1:29 AM
 */


class ItemM1 extends Item{

    var $reflection_img;
    var $shading_img;


    function get_reflection_img_name(){
        return $this->reflection_img;
    }

    function get_shading_img_name(){
        return $this->shading_img;
    }
}