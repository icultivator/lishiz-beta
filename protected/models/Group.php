<?php

/**
 * This is the model class for table "{{group}}".
 *
 * The followings are the available columns in table '{{group}}':
 * @property string $id
 * @property string $name
 * @property string $intro
 * @property string $cover
 * @property string $tags
 * @property string $votes
 * @property string $views
 * @property string $members
 * @property string $user_id
 * @property integer $status
 * @property string $create_time
 * @property string $last_update
 */
class Group extends CActiveRecord
{
    const GROUP_OFFLINE = 0;
    const GROUP_ONLINE = 1;

    public $oldTags = '';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, intro,cover', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('intro', 'length', 'max'=>255),
			array('cover, tags', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, intro, cover, tags, votes, members, user_id, status, create_time, last_update', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '小组名',
			'intro' => '简介',
			'cover' => '封面图',
			'tags' => '标签',
			'votes' => '点赞',
			'members' => '会员',
			'user_id' => '创建者',
			'status' => '状态',
			'create_time' => '创建时间',
			'last_update' => '最后更改',
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
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('votes',$this->votes,true);
		$criteria->compare('members',$this->members,true);
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
	 * @return Group the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->members = 1;
            $this->last_update = $this->create_time = time();
        }else{
            if($this->getScenario()=='update')
                $this->last_update = time();
        }
        return parent::beforeSave();
    }

    protected function afterSave(){
        if(in_array($this->getScenario(),array('create','update'))):
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
        endif;
    }

    protected function afterDelete(){
        $delTags = explode(',',$this->tags);
        $objTags = new Tags();
        $objTags->delTags($delTags);
    }

    public function addNewMember($group_id,$user_id){
        $gid = intval($group_id);
        $uid = intval($user_id);
        if(!$gid || !$uid){
            return false;
        }
        $query = 'SELECT * FROM {{group_member}} WHERE group_id = :gid AND user_id = :uid';
        $db = Yii::app()->db->createCommand($query);
        $db->bindParam(':gid',$gid,PDO::PARAM_INT);
        $db->bindParam(':uid',$uid,PDO::PARAM_INT);
        $rs = $db->queryRow();
        if($rs){
            return false;
        }
        $insert = 'INSERT INTO {{group_member}}(user_id,group_id) VALUES (:uid,:gid)';
        $db = Yii::app()->db->createCommand($insert);
        $db->bindParam(':gid',$gid,PDO::PARAM_INT);
        $db->bindParam(':uid',$uid,PDO::PARAM_INT);
        $flag = $db->execute();
        if($flag){
            return true;
        }else{
            return false;
        }
    }

    public function vote($group_id,$user_id){

    }
}
