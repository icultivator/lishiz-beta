<?php
/**
 * Created by PhpStorm.
 * User: heidi
 * Date: 2014/11/27
 * Time: 15:13
 */
class EnumItem{
    const ITEM_USER = 1;
    const ITEM_POST = 2;
    const ITEM_BOOK = 3;
    const ITEM_VIDEO = 4;
    const ITEM_GROUP = 5;
    const ITEM_TOPIC = 6;
    const ITEM_ASK = 7;
    const ITEM_COMMENT = 8;

    public static function get($obj_type){
        switch($obj_type){
            case self::ITEM_USER:
                $obj = 'user';
                break;
            case self::ITEM_POST:
                $obj = 'post';
                break;
            case self::ITEM_BOOK:
                $obj = 'book';
                break;
            case self::ITEM_VIDEO:
                $obj = 'video';
                break;
            case self::ITEM_GROUP:
                $obj = 'group';
                break;
            case self::ITEM_TOPIC:
                $obj = 'topic';
                break;
            case self::ITEM_ASK:
                $obj = 'ask';
                break;
            case self::ITEM_COMMENT:
                $obj = 'comment';
                break;
        }
        return $obj;
    }
}