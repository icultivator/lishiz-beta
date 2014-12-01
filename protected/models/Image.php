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
			array('title, cover,tags', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, cover,tags', 'length', 'max'=>100),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, cover, content, status, views, votes, collects, comments, user_id, upload_time, last_update', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'cover' => 'Cover',
			'content' => 'Content',
            'tags' => '标签',
			'status' => 'Status',
			'views' => 'Views',
			'votes' => 'Votes',
			'collects' => 'Collects',
			'comments' => 'Comments',
			'user_id' => 'User',
			'upload_time' => 'Upload Time',
			'last_update' => 'Last Update',
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
		$criteria->compare('upload_time',$this->upload_time,true);
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
            $this->last_update = $this->upload_time = time();
        }else{
            $this->last_update = time();
        }
        return parent::beforeSave();
    }

    public function afterSave(){

    }
}
