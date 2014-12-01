<?php

class FollowController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('add','cancel'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAdd(){
        $obj_id = $_POST['obj_id'];
        $obj_type = $_POST['obj_type'];
        $user_id = Yii::app()->user->id;
        $model = $this->loadModel($obj_id,$obj_type,$user_id);
        $model->obj_id = $obj_id;
        $model->obj_type = $obj_type;
        $model->user_id = $user_id;
        if($model->save()){
            echo CJSON::encode(array('success'=>'操作成功！'));
        }else{
            echo CJSON::encode(array('msg'=>'操作失败，请重试！'));
        }
    }

    public function actionCancel(){
        $obj_id = $_POST['obj_id'];
        $obj_type = $_POST['obj_type'];
        $user_id = Yii::app()->user->id;
        $model = $this->loadModel($obj_id,$obj_type,$user_id,'cancel');
        if(!$model){
            echo CJSON::encode(array('msg'=>'尚未关注！'));
            exit;
        }
        if($model->delete()){
            echo CJSON::encode(array('success'=>'取消关注成功！'));
        }else{
            echo CJSON::encode(array('msg'=>'操作失败，请重试！'));
        }
    }

    private  function loadModel($obj_id,$obj_type,$user_id,$opt_type='add'){
        $objString = ucfirst(ObjType::get($obj_type));
        $obj = $objString::model()->findByPk($obj_id);
        if(!$obj){
            echo CJSON::encode(array('msg'=>'操作项不存在！'));
            exit;
        }
        if($objString=='User' && $obj->id == $user_id){
            echo CJSON::encode(array('msg'=>'不能关注自己！'));
            exit;
        }
        if($objString=='Topic' && $obj->user_id == $user_id){
            echo CJSON::encode(array('msg'=>'不能关注自己创建的小组！'));
            exit;
        }
        $model = UserFollow::model()->find('obj_id=:oid AND obj_type=:type AND user_id=:uid',
            array(':oid'=>$obj_id,':type'=>$obj_type,':uid'=>$user_id));
        switch($opt_type){
            case 'add':
                if($model){
                    echo CJSON::encode(array('msg'=>'已经关注过了！'));
                    exit;
                }else{
                    $model = new UserFollow();
                }
                break;
            case 'cancel':
                if(!$model){
                    echo CJSON::encode(array('msg'=>'尚未关注！'));
                    exit;
                }
                break;
        }
        return $model;
    }
}
?>