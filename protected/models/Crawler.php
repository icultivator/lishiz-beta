<?php

/**
 * This is the model class for table "{{crawler}}".
 *
 * The followings are the available columns in table '{{crawler}}':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $site
 * @property string $list
 * @property string $detail
 * @property string $detail_title
 * @property string $detail_content
 * @property string $detail_cover
 * @property string $detail_tags
 * @property string $user_id
 * @property string $create_time
 * @property string $last_update
 */
class Crawler extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{crawler}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, site, list, detail, detail_title, detail_content, detail_cover', 'required'),
			array('title, site', 'length', 'max'=>100),
            array('target', 'numerical', 'integerOnly'=>true),
			array('list, detail, detail_title, detail_content, detail_cover, detail_tags', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, site, list, detail, detail_title, detail_content, detail_cover, detail_tags, user_id, create_time, last_update', 'safe', 'on'=>'search'),
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
			'title' => '标题',
            'target' => '目标模块',
			'description' => '描述',
			'site' => '爬取站点',
			'list' => '列表页规则',
			'detail' => '详情页规则',
			'detail_title' => '详情标题规则',
			'detail_content' => '详情内容规则',
			'detail_cover' => '封面图规则',
			'detail_tags' => '详情标签规则',
			'user_id' => 'User',
			'create_time' => 'Create Time',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('list',$this->list,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('detail_title',$this->detail_title,true);
		$criteria->compare('detail_content',$this->detail_content,true);
		$criteria->compare('detail_cover',$this->detail_cover,true);
		$criteria->compare('detail_tags',$this->detail_tags,true);
		$criteria->compare('user_id',$this->user_id,true);
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
	 * @return Crawler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if($this->isNewRecord){
            $this->user_id = Yii::app()->user->id;
            $this->create_time = $this->last_update = time();
        }else{
            $this->last_update = time();
        }
        return parent::beforeSave();
    }
}
