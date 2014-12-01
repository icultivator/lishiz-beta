<?php

/**
 * This is the model class for table "{{ask}}".
 *
 * The followings are the available columns in table '{{ask}}':
 * @property string $id
 * @property string $question
 * @property string $desc
 * @property string $tags
 * @property string $votes
 * @property string $views
 * @property string $answers
 * @property string $user_id
 * @property integer $status
 * @property string $create_time
 * @property string $last_update
 */
class Ask extends CActiveRecord
{
    const ASK_DRAFT = 0;
    const ASK_PUBLISHED = 1;

    public $oldTags = '';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ask}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question,tags', 'required'),
            array('desc','safe'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('question, tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, desc, tags, votes, views, answers, user_id, status, create_time, last_update', 'safe', 'on'=>'search'),
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
			'question' => '问题',
			'desc' => '描述',
			'tags' => '标签',
			'votes' => '点赞',
			'views' => '浏览',
			'answers' => '回答',
			'user_id' => '提问者',
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
		$criteria->compare('question',$this->question,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('answers',$this->answers,true);
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
	 * @return Ask the static model class
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
        if(in_array($this->getScenario(),array('create','update'))){
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
        }
    }

    protected function afterDelete(){
        $delTags = explode(',',$this->tags);
        $objTags = new Tags();
        $objTags->delTags($delTags);
    }

    public function vote($ask_id,$user_id){
        $aid = intval($ask_id);
        $uid = intval($user_id);
        $obj_type = Yii::app()->params['obj_type']['ask'];
        $query = 'SELECT * FROM {{user_vote}} WHERE user_id = :uid AND obj_id = :aid AND obj_type = '.$obj_type;
        $db = Yii::app()->db->createCommand($query);
        $db->bindParam(':uid',$uid,PDO::PARAM_INT);
        $db->bindParam(':aid',$aid,PDO::PARAM_INT);
        $rs = $db->queryRow();
        if($rs){
            return false;
        }else{
            $insert = 'INSERT INTO {{user_vote}}(user_id,obj_id,obj_type) VALUES (:uid,:aid,:type)';
            $db = Yii::app()->db->createCommand($insert);
            $db->bindParam(':uid',$uid,PDO::PARAM_INT);
            $db->bindParam(':aid',$aid,PDO::PARAM_INT);
            $db->bindParam(':type',$obj_type,PDO::PARAM_INT);
            $flag = $db->execute();
            if($flag){
                return true;
            }else{
                return false;
            }
        }
    }

    public function follow($ask_id,$user_id){
        $aid = intval($ask_id);
        $uid = intval($user_id);
        if(!$aid || !$uid){
            return false;
        }
        $obj_type = Yii::app()->params['obj_type']['ask'];
        $query = 'SELECT * FROM {{user_follow}} WHERE obj_id = :aid AND user_id = :uid AND obj_type = '.$obj_type;
        $db = Yii::app()->db->createCommand($query);
        $db->bindParam(':aid',$aid,PDO::PARAM_INT);
        $db->bindParam(':uid',$uid,PDO::PARAM_INT);
        $rs = $db->queryRow();
        if($rs){
            return false;
        }
        $insert = 'INSERT INTO {{user_follow}}(user_id,obj_id,obj_type) VALUES (:uid,:aid,:type)';
        $db = Yii::app()->db->createCommand($insert);
        $db->bindParam(':aid',$aid,PDO::PARAM_INT);
        $db->bindParam(':uid',$uid,PDO::PARAM_INT);
        $db->bindParam(':type',$obj_type,PDO::PARAM_INT);
        $flag = $db->execute();
        if($flag){
            return true;
        }else{
            return false;
        }
    }
}
