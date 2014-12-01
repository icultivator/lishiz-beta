<?php

/**
 * This is the model class for table "{{image}}".
 *
 * The followings are the available columns in table '{{image}}':
 * @property string $id
 * @property string $title
 * @property string $cover
 * @property string $content
 * @property integer $status
 * @property string $views
 * @property string $votes
 * @property string $collects
 * @property string $comments
 * @property string $user_id
 * @property string $upload_time
 * @property string $last_update
 */
class Image extends CActiveRecord
{

    const Image_DRAFT = 0;
    const Image_PUBLISHED = 1;

    public $oldTags = '';
    public $obj_type = 0;
    private $userFlow = NULL;
    private $userMessage = NULL;

    public function __construct($scenario='insert'){
        $this->obj_type = Yii::app()->params['obj_type']['image'];
        $this->userFlow = new UserFlow();
        $this->userMessage = new UserMessage();
        return parent::__construct($scenario);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, cover, tags', 'required'),
            array('title','unique'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, cover,tags', 'length', 'max'=>100),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, cover, content, status, views, votes, collects, comments, user_id, create_time, last_update', 'safe', 'on'=>'search'),
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
			'title' => '标题',
			'cover' => '封面图',
			'content' => '详情',
            'tags' => '标签',
			'status' => '状态',
			'views' => '浏览',
			'votes' => '点赞',
			'collects' => '收藏',
			'comments' => '评论',
			'user_id' => '创建者',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('collects',$this->collects,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('create_time',$this->upload_time,true);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->last_update = $this->create_time = time();
        }else{
            if($this->getScenario()=='update')
                $this->last_update = time();
        }
        return parent::beforeSave();
    }

    public function afterSave(){
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
        if(Yii::app()->user->id != $this->user_id){
            $subject = "您的".Yii::t('item',ObjType::get($this->obj_type)).'有了新'.
                Yii::t('opt',$this->getScenario());
            $content = Yii::app()->user->name.Yii::t('opt',$this->getScenario()).'您的'.
                Yii::t('item',ObjType::get($this->obj_type)).'：'.CHtml::link($this->title,'/post/'.$this->id);
            $this->userMessage->send($this->user_id,$subject,$content);
        }
    }

    public function isVoted(){
        return UserVote::model()->isVoted($this->id,$this->obj_type);
    }

    public function isCollected(){
        return UserCollect::model()->isCollected($this->id,$this->obj_type);
    }
}
