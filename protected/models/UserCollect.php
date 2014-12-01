<?php

/**
 * This is the model class for table "{{user_collect}}".
 *
 * The followings are the available columns in table '{{user_collect}}':
 * @property string $user_id
 * @property string $obj_id
 * @property integer $obj_type
 */
class UserCollect extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_collect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, obj_id, obj_type', 'required'),
			array('obj_type', 'numerical', 'integerOnly'=>true),
			array('user_id, obj_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, obj_id, obj_type', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'obj_id' => 'Obj',
			'obj_type' => 'Obj Type',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('obj_id',$this->obj_id,true);
		$criteria->compare('obj_type',$this->obj_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserCollect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function afterSave(){
        $objString = ucfirst(ObjType::get($this->obj_type));
        $optObj = $objString::model()->findByPk($this->obj_id);
        if($optObj){
            $optObj->setScenario('collect');
            $optObj->collects += 1;
            $optObj->save(false);
        }
    }

    public function afterDelete(){
        $objString = ucfirst(ObjType::get($this->obj_type));
        $optObj = $objString::model()->findByPk($this->obj_id);
        if($optObj){
            $optObj->setScenario('cancel_collect');
            $optObj->collects -= 1;
            $optObj->save(false);
        }
    }

    public function isCollected($obj_id,$obj_type){
        $conditions = 'user_id = :uid AND obj_id = :oid AND obj_type= :type';
        $params = array(':uid'=>Yii::app()->user->id,':oid'=>$obj_id,':type'=>$obj_type);
        if($this->find($conditions,$params)){
            $is_collected = true;
        }else{
            $is_collected = false;
        }
        return $is_collected;
    }
}

