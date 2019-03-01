<?php
/**
 * Created by PhpStorm.
 * User: vandung
 * Date: 22/02/2019
 * Time: 14:17
 */

namespace Dungbv\Banner\Helper;

use Magento\Framework\Exception\LocalizedException;


class Validation
{

    public function required($field){
        if(empty($_POST[$field])){
            throw new LocalizedException(__('%1 is required',$field));
        }
    }

    public  function rule(){
        $args = func_get_args();

        foreach ($args[0] as $key=>$arg) {
            $rules = explode("|", $arg);
            foreach ($rules as $index=>$rule) {
                call_user_func(array($this,(string)$rule),$key);
            }
        }
    }
}