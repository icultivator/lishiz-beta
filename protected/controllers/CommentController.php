<?php

class CommentController extends Controller
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate(){
        $parent_id = $_POST['parent_id'];
        $obj_id = $_POST['obj_id'];
        $obj_type = $_POST['obj_type'];
        $comment_to = $_POST['comment_to'];
        $content = $_POST['comment'];
        $model = new Comment('create');
        $model->parent_id = $parent_id;
        $model->comment_to = $comment_to;
        $model->obj_id = $obj_id;
        $model->obj_type = $obj_type;
        $model->content = $content;
        if($model->save()){
            echo CJSON::encode(array('msg'=>'发表评论成功！'));
        }else{
            echo CJSON::encode(array('msg'=>'发表评论失败！'));
        }
    }
}
?>