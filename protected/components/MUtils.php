<?php
/**
 * Created by PhpStorm.
 * User: sunqiang3
 * Date: 2014/12/2
 * Time: 11:22
 */
class MUtils{
    public static function isSameDay($day1,$day2){
        $day1 = getdate($day1);
        $day2 = getdate($day2);
        if($day1['year']==$day2['year']&&$day1['yday']==$day2['yday']){
            return true;
        }else{
            return false;
        }
    }
}