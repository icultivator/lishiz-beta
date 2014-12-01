<?php

/**
 * This is the model class for table "{{topic}}".
 *
 * The followings are the available columns in table '{{topic}}':
 * @property string $id
 * @property string $group_id
 * @property string $title
 * @property string $desc
 * @property string $tags
 * @property string $votes
 * @property string $views
 * @property string $comments
 * @property string $user_id
 * @property integer $status
 * @property string $create_time
 * @property string $last_update
 */
class Topic extends CActiveRecord
{
    const TOPIC_DRAFT = 0;
    const TOPIC_PUBLISHED = 1;

    public $oldTags = '';
    public $obj_type = 0;
    private $userFlow = NULL;
    private  $userMessage = NULL;

    public function __construct($scenario='insert'){
        $this->oldTags = '';
        $this->obj_type = Yii::app()->params['obj_type']['topic'];
        $this->userFlow = new UserFlow();
        $this->userMessage = new UserMessage();
        parent::__construct($scenario);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{topic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, tags', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, tags, votes, views, comments, user_id, status, create_time, last_update', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => '小组ID',
			'title' => '标题',
			'desc' => '描述',
			'tags' => '标签',
			'votes' => '点赞',
			'views' => '浏览',
			'comments' => '评论',
			'user_id' => '创建者',
			'status' => '状态',
			'create_time' => '创建时间',
			'last_update' => '最后更新',
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
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Topic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->last_update = $this->create_time = time();
        }else{
            if($this->getScenario()=='update')
                $this->last_update = time();
        }
        return parent::beforeSave();
    }

    protected function afterSave(){
        switch($this->getScenario()){
            case 'create':
            case 'update':
                //更新tags
                if($this->isNewRecord){
                    $arrNewTags = explode(',',$this->tags);
                    $arrOldTags = array();
                }else{
                    $arrNewTags = explode(',',$this->tags);
                    $arrOldTags = explode(',',$this->oldTags);
                }
                $addTags = array_diff($arrNewTags,$arrOldTags);
                $delTags = array_diff($arrOldTags,$arrNewTags);

                $objTags = new Tags();
                $objTags->addTags($addTags);
                $objTags->delTags($delTags);
                break;
        }
        //新增用户操作时间流
        if($this->getScenario()!='view'){
            $this->flow();
            $this->message();
        }
    }

    protected function afterDelete(){
        $delTags = explode(',',$this->tags);
        $objTags = new Tags();
        $objTags->delTags($delTags);
    }

    public function flow(){
        $this->userFlow->user_id = Yii::app()->user->id;
        $this->userFlow->obj_id = $this->id;
        $this->userFlow->obj_type = $this->obj_type;
        $this->userFlow->obj_status = $this->status;
        $this->userFlow->obj_title = $this->title;
        $this->userFlow->opt_type = Yii::app()->params['opt_type'][$this->getScenario()];
        $this->userFlow->save(false);
    }

    public function message(){
        if(Yii::app()->user->id != $this->user_id) {
            $subject = "您的" . Yii::t('item', ObjType::get($this->obj_type)) . '有了新' .
                Yii::t('opt', $this->getScenario());
            $content = Yii::app()->user->name . Yii::t('opt', $this->getScenario()) . '您的' .
                Yii::t('item', ObjType::get($this->obj_type)) . '：' . CHtml::link($this->title, '/topic/' . $this->id);
            $this->userMessage->send($this->user_id, $subject, $content);
        }
    }

    public function isVoted(){
        return UserVote::model()->isVoted($this->id,$this->obj_type);
    }

    public function isFollowed(){
        return UserFollow::model()->isFollowed($this->id,$this->obj_type);
    }
}


