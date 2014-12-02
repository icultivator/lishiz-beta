<?php
/**
 * Created by PhpStorm.
 * User: sunqiang3
 * Date: 2014/12/2
 * Time: 10:53
 */
class MPointManager{

    //每天只能获得一次登录积分
    public static function login(){
        if(Yii::app()->user->isGuest){
            return 0;
        }
        $user = User::model()->findByPk(Yii::app()->user->id);
        $current = time();
        if(MUtils::isSameDay($user->last_login,$current)){
            return 0;
        }else{
            return 5;
        }
    }

    public static function avatar(){
        if(Yii::app()->user->isGuest){
            return 0;
        }
        //$user = User::model()->findByPk(Yii::app()->user->id);
        $point = 20;
        return $point;
    }

    public static function create($obj_type){
        $objString  = ucfirst(ObjType::get($obj_type));
        $obj = $objString::model()->find('user_id = :uid',array(':uid'=>Yii::app()->user->id));
        switch($obj_type){
            case ObjType::ITEM_BOOK:
            case ObjType::ITEM_IMAGE:
            case ObjType::ITEM_POST:
            case ObjType::ITEM_VIDEO:
                if($obj){
                    $point = 50;
                }else{
                    $point = 100;
                }
                break;
            case ObjType::ITEM_TOPIC:
                if($obj){
                    $point = 20;
                }else{
                    $point = 50;
                }
        }
        return $point;
    }

    public static function collect($opt_type){
        switch($opt_type){
            case OptType::OPT_COLLECT:
                $point = 5;
                break;
            case OptType::OPT_CANCEL_COLLECT:
                $point = -5;
                break;
        }
        return $point;
    }

    public static function comment($obj_type){
        switch($obj_type){
            case ObjType::ITEM_BOOK:
            case ObjType::ITEM_IMAGE:
            case ObjType::ITEM_POST:
            case ObjType::ITEM_VIDEO:
                $point = 10;
                break;
            case ObjType::ITEM_COMMENT:
                $point = 5;
                break;
            case ObjType::ITEM_TOPIC:
                $point = 15;
                break;
        }
        return $point;
    }

    public static function update($obj_type){
        switch($obj_type){
            case ObjType::ITEM_USER:
                $point = 20;
                break;
        }
        return $point;
    }

    public static function verify($verify_type){
        switch($verify_type){
            case 'email':
                $point = 20;
                break;
        }
        return $point;
    }

    public static function vote($opt_type){
        switch($opt_type){
            case OptType::OPT_VOTE:
                $point = 5;
                break;
            case OptType::OPT_CANCEL_VOTE:
                $point = -5;
                break;
        }
        return $point;
    }

    public static function follow($opt_type){
        switch($opt_type){
            case OptType::OPT_FOLLOW:
                $point = 5;
                break;
            case OptType::OPT_CANCEL_FOLLOW:
                $point = -5;
                break;
        }
    }

    public static function view($views){
        if($views>=500){
            $point = ($views/500)*10;
        }
        return $point;
    }

    public static function grade($point){
        switch($point){
            case $point < pow(2,7):
                $level = 1;
                break;
            case $point < pow(2,8):
                $level = 2;
                break;
            case $point < pow(2,9):
                $level = 3;
                break;
            case $point < pow(2,10):
                $level = 4;
                break;
            case $point < pow(2,11):
                $level = 5;
                break;
            case $point < pow(2,12):
                $level = 6;
                break;
            case $point < pow(2,13):
                $level = 7;
                break;
            case $point < pow(2,14):
                $level = 8;
                break;
            case $point < pow(2,15):
                $level = 9;
                break;
            case $point < pow(2,16):
                $level = 10;
                break;
            case $point < pow(2,17):
                $level = 11;
                break;
            case $point < pow(2,18):
                $level = 12;
                break;
            case $point < pow(2,19):
                $level = 13;
                break;
            case $point < pow(2,20):
                $level = 14;
                break;
            case $point < pow(2,21):
                $level = 15;
                break;
            case $point < pow(2,22):
                $level = 16;
                break;
            case $point < pow(2,23):
                $level = 17;
                break;
            case $point < pow(2,24):
                $level = 18;
                break;
            case $point < pow(2,25):
                $level = 19;
                break;
            case $point < pow(2,26):
                $level = 20;
                break;
            case $point < pow(2,27):
                $level = 21;
                break;
            case $point >= pow(2,28):
                $level = 22;
                break;
        }
        return $level;
    }
}