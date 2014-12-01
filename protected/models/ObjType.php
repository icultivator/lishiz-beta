<?php
/**
 * Created by PhpStorm.
 * User: heidi
 * Date: 2014/11/27
 * Time: 15:13
 */
class ObjType{
    const ITEM_USER = 1;
    const ITEM_POST = 2;
    const ITEM_IMAGE = 3;
    const ITEM_BOOK = 4;
    const ITEM_VIDEO = 5;
    const ITEM_TOPIC = 6;
    const ITEM_COMMENT = 7;

    public static function get($obj_type){
        switch($obj_type){
            case self::ITEM_USER:
                $obj = 'user';
                break;
            case self::ITEM_POST:
                $obj = 'post';
                break;
            case self::ITEM_IMAGE:
                $obj = 'image';
                break;
            case self::ITEM_BOOK:
                $obj = 'book';
                break;
            case self::ITEM_VIDEO:
                $obj = 'video';
                break;
            case self::ITEM_TOPIC:
                $obj = 'topic';
                break;
            case self::ITEM_COMMENT:
                $obj = 'comment';
                break;
        }
        return $obj;
    }
}