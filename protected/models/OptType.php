<?php
/**
 * Created by PhpStorm.
 * User: heidi
 * Date: 2014/11/27
 * Time: 15:13
 * 'create'=>1,
'update'=>2,
'collect'=>3,
'cancel_collect'=>4,
'vote'=>5,
'cancel_vote'=>6,
'follow'=>7,
'cancel_follow'=>8,
'comment'=>9
 */
class OptType{
    const OPT_CREATE = 1;
    const OPT_UPDATE = 2;
    const OPT_COLLECT = 3;
    const OPT_CANCEL_COLLECT = 4;
    const OPT_VOTE = 5;
    const OPT_CANCEL_VOTE = 6;
    const OPT_FOLLOW = 7;
    const OPT_CANCEL_FOLLOW = 8;
    const OPT_COMMENT = 9;

    public static function get($opt_type){
        switch($opt_type){
            case self::OPT_CREATE:
                $opt = 'create';
                break;
            case self::OPT_UPDATE:
                $opt = 'update';
                break;
            case self::OPT_COLLECT:
                $opt = 'collect';
                break;
            case self::OPT_CANCEL_COLLECT:
                $opt = 'cancel_collect';
                break;
            case self::OPT_VOTE:
                $opt = 'vote';
                break;
            case self::OPT_CANCEL_VOTE:
                $opt = 'cancel_vote';
                break;
            case self::OPT_FOLLOW:
                $opt = 'follow';
                break;
            case self::OPT_CANCEL_FOLLOW:
                $opt = 'cancel_follow';
                break;
            case self::OPT_COMMENT:
                $opt = 'comment';
                break;
        }
        return $opt;
    }
}