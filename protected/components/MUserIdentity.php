<?php
/**
 * Created by PhpStorm.
 * User: heidi
 * Date: 2014/11/26
 * Time: 14:05
 */
class MUserIdentity extends UserIdentity{
    public $id;
    public $avatar;
    public function authenticate(){
        $sql = 'SELECT id,pass,avatar FROM {{user}} WHERE `name`=:name';
        $user = User::model()->findBySql($sql,array(':name'=>$this->username));
        if(!isset($user))
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif($user->pass!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else{
            $this->id = $user->id;
            $this->avatar = $user->avatar;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId(){
        return $this->id;
    }

    public function getAvatar(){
        return $this->avatar;
    }
}