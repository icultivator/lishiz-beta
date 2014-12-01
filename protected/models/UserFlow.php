<?php

/**
 * This is the model class for table "{{user_flow}}".
 *
 * The followings are the available columns in table '{{user_flow}}':
 * @property string $id
 * @property string $user_id
 * @property string $obj_id
 * @property string $obj_title
 * @property integer $obj_type
 * @property integer $obj_status
 * @property string $log_time
 */
class UserFlow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_flow}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, obj_id, obj_title, obj_type', 'required'),
			array('obj_type, obj_status', 'numerical', 'integerOnly'=>true),
			array('user_id, obj_id, obj_title, log_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, obj_id, obj_title, obj_type, obj_status, log_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'obj_id' => 'Obj',
			'obj_title' => 'Obj Title',
			'obj_type' => 'Obj Type',
			'obj_status' => 'Obj Status',
			'log_time' => 'Log Time',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('obj_id',$this->obj_id,true);
		$criteria->compare('obj_title',$this->obj_title,true);
		$criteria->compare('obj_type',$this->obj_type);
		$criteria->compare('obj_status',$this->obj_status);
		$criteria->compare('log_time',$this->log_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserFlow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        $this->log_time = time();
        return parent::beforeSave();
    }

}
