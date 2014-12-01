<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property string $id
 * @property integer $type
 * @property string $obj_id
 * @property string $parent_id
 * @property string $content
 * @property string $votes
 * @property string $user_id
 * @property integer $status
 * @property string $commet_time
 */
class Comment extends CActiveRecord
{

    const COMMENT_ALLOWED = 1;
    const COMMENT_FORBIDDEN = 0;

    /*public $obj_type = 0;

    public function __construct($scenario='insert'){
        $this->obj_type = Yii::app()->params['obj_type']['comment'];
        parent::__construct($scenario);
    }*/

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('obj_type,obj_id, content, comment_to', 'required'),
			array('obj_type,status', 'numerical', 'integerOnly'=>true),
			array('obj_id, parent_id,comment_to', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, obj_id, parent_id, content, votes, user_id, status, comment_time', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','user_id'),
            'subs'=>array(self::HAS_MANY,'Comment','parent_id'),
            'parent'=>array(self::BELONGS_TO,'Comment','parent_id'),
            'commented'=>array(self::BELONGS_TO,'User','comment_to')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'obj_id' => 'Obj',
			'parent_id' => 'Parent',
			'content' => 'Content',
			'votes' => 'Votes',
			'user_id' => 'User',
			'status' => 'Status',
			'comment_time' => 'Comment Time',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('obj_id',$this->obj_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('comment_time',$this->commet_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->comment_time = time();
            $this->status = self::COMMENT_ALLOWED;
        }
        return parent::beforeSave();
    }

    public function afterSave(){
        $objString = ucfirst(ObjType::get($this->obj_type));
        $obj = $objString::model()->findByPk($this->obj_id);
        $obj->setScenario('comment');
        $obj->comments += 1;
        $obj->save(false);
        //通知被回复用户
        if($this->parent_id){
            $this->message($obj->title);
        }
    }

    public function message($title){
        $userMessage = new UserMessage();
        $subject = '您有一条新回复';
        $content = Yii::app()->user->name.'于'.date('Y-m-d H:i:s',$this->comment_time).
            '回复了您的评论：'.CHtml::link($title,'/'.ObjType::get($this->obj_type).'/'.$this->obj_id);
        $userMessage->send($this->comment_to,$subject,$content);
    }

}
