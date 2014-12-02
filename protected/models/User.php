<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $pass
 * @property string $avatar
 * @property integer $role
 * @property integer $level
 * @property string $point
 * @property string $qq
 * @property string $weixin
 * @property string $weibo
 * @property string $site
 * @property integer $status
 * @property string $register_time
 * @property string $last_update
 * @property string $last_login
 */
class User extends CActiveRecord
{
    public $repass = '';
    public $oldpass = '';
    public $newpass = '';

    public $obj_type = 0;
    public $is_own = false;
    private $userFlow = NULL;
    private $userMessage = NULL;

    public function __construct($scenario='insert'){
        $this->obj_type = Yii::app()->params['obj_type']['user'];
        $this->is_own = Yii::app()->user->id==$this->id?true:false;
        $this->userFlow = new UserFlow();
        $this->userMessage = new UserMessage();
        parent::__construct($scenario);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, pass,repass', 'required','on'=>'register,create'),
            array('name,email','unique'),
            array('email','email'),
            array('repass','compare','compareAttribute'=>'pass','on'=>'register,create'),
            array('oldpass,newpass,repass','required','on'=>'repass'),
            array('oldpass','repassword','on'=>'repass'),
            array('repass','compare','compareAttribute'=>'newpass','on'=>'repass'),
			array('name, qq', 'length', 'max'=>16),
			array('email, weixin', 'length', 'max'=>32),
			array('avatar, weibo, site', 'length', 'max'=>100),
            array('intro', 'length', 'max'=>200),
			// The following rule is used by search().
			array('id, name, email, pass, avatar, role, level, point, qq, weixin, weibo, site, status, register_time, last_update, last_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

		);
	}

    public function repassword(){
        if(!$this->hasErrors())
        {
            if(md5($this->oldpass) != $this->pass)
                $this->addError('oldpass','原密码输入不正确！');
        }
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '用户名',
			'email' => '邮箱',
			'pass' => '密码',
            'repass'=>'确认密码',
            'oldpass'=>'原密码',
			'avatar' => '头像',
            'intro'=>'个人简介',
			'role' => '类型',
			'level' => '称号',
			'point' => '积分',
			'qq' => 'QQ号',
			'weixin' => '微信号',
			'weibo' => '新浪微博',
			'site' => '个人站点',
			'status' => '状态',
			'register_time' => '注册时间',
			'last_update' => '最后更新',
			'last_login' => '上次登录',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('level',$this->level);
		$criteria->compare('point',$this->point,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('weixin',$this->weixin,true);
		$criteria->compare('weibo',$this->weibo,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('register_time',$this->register_time,true);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('last_login',$this->last_login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->register_time = time();
            $this->pass = md5($this->pass);
        }else{
            if($this->getScenario()=='repass'){
                $this->pass = md5($this->newpass);
            }
        }
        return parent::beforeSave();
    }

    public function afterSave(){
        $this->message();
    }

    //关注多少人
    public function getFollowing(){
        $sql = 'SELECT COUNT(*) FROM {{user_follow}} WHERE user_id=:uid AND obj_type=:type';
        $params = array('uid'=>Yii::app()->user->id,':type'=>Yii::app()->params['obj_type']['user']);
        $follows = UserFollow::model()->countBySql($sql,$params);
        return $follows;
    }

    //被多少人关注
    public function getFollowed(){
        $sql = 'SELECT COUNT(*) FROM {{user_follow}} WHERE obj_id = :uid AND obj_type=:type';
        $params = array('uid'=>$this->id,':type'=>Yii::app()->params['obj_type']['user']);
        $followed = UserFollow::model()->countBySql($sql,$params);
        return $followed;
    }

    public function message(){
        switch($this->scenario){
            case 'register':
                $subject = '感谢注册历史志';
                $content = '亲爱的'.$this->name.'，感谢您注册历史志，成为历史爱好者大家庭的一员，历史志——为历史爱好者而生！';
                $this->userMessage->send($this->id,$subject,$content);
                break;
            case 'repass':
                $subject = '重置密码';
                $content = '您于'.date('Y-m-d H:i:s',time()).'重置了密码，如果不是本人操作，请通过邮箱找回密码修改！';
                $this->userMessage->send($this->id,$subject,$content);
                break;
            case 'avatar':
                $subject = '修改头像';
                $content = '您于'.date('Y-m-d H:i:s',time()).'修改了头像';
                $this->userMessage->send($this->id,$subject,$content);
                break;
            case 'follow':
                $subject = '新用户关注';
                $content = Yii::app()->user->name.'于'.date('Y-m-d H:i:s',time()).'关注了您！';
                $this->userMessage->send($this->id,$subject,$content);
                break;
        }
    }

    public function  point(){
        switch($this->getScenario()){
            case 'register':
                $this->point += 50;
                $this->save(false);
                break;
            case 'login':
                $this->point +=5;
                $this->save(false);
                break;
            case OptType::get(OptType::OPT_FOLLOW):
                $this->point +=3;
                $this->save(false);
                $opt_user = User::model()->findByPk(Yii::app()->user->id);
                $opt_user->point -= 5;
                $opt_user->save(false);
                break;
            case OptType::get(OptType::OPT_CANCEL_FOLLOW):
                $this->point -=3;
                $this->save(false);
                $opt_user = User::model()->findByPk(Yii::app()->user->id);
                $opt_user->point -= 5;
                $opt_user->save(false);
                break;
            case OptType::get(OptType::OPT_UPDATE):
                $this->point +=20;
                $this->save(false);
                break;
            case 'avatar':
                $this->point +=20;
                $this->save(false);
                break;
        }
    }
}
