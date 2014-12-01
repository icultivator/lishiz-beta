<?php

class ImageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','addimage'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $model->setScenario('view');

        if(isset($_GET['preview'])){
            $model->views += 1;
            $model->save(false);
        }

        $criteria = new CDbCriteria();
        $criteria->condition = 'obj_type=:type AND obj_id = :oid AND status = :status AND parent_id = 0';
        $criteria->params = array(':type'=>$model->obj_type,':oid'=>$id,':status'=>Comment::COMMENT_ALLOWED);
        $criteria->order = 'comment_time DESC';
        $comments = new CActiveDataProvider('Comment',array(
            'criteria'=>$criteria
        ));

		$this->render('view',array(
			'model'=>$model,
            'comments'=>$comments
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Image('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $model->setScenario('update');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
            $model->oldTags = $model->tags;
			$model->attributes=$_POST['Image'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria();
        $criteria->select = 'id,title,cover,views,votes,tags,last_update,create_time';
        $criteria->condition = 'status = :status';
        $criteria->params = array(':status'=>Image::Image_PUBLISHED);
        $criteria->order = 'create_time DESC';
        $dataProvider=new CActiveDataProvider('Image',array('criteria'=>$criteria));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Image('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Image']))
			$model->attributes=$_GET['Image'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Image the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Image::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Image $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUpload(){
        //读取图像上传域,并使用系统上传组件上传
        $tmpFile   = CUploadedFile::getInstanceByName('image');

        if(is_object($tmpFile) && get_class($tmpFile)==='CUploadedFile'){
            $name = md5(Yii::app()->user->id.time());
            //上传文件的扩展名
            $ext = $tmpFile->extensionName;
            $filename = $name.'.'.$ext;

            $picmanager = new MPicManager();
            $filepath = $picmanager->getLocalPath($filename);
            $tmpFile->saveAs($filepath);

            if(file_exists($filepath)){
                $userUpload = new UserUpload();
                $userUpload->path = $picmanager->getWebPath($filename);
                $userUpload->save(false);
                //生成缩略图
                $picmanager->thumb($filepath);
                echo CJSON::encode(array('cover'=>$picmanager->getWebPath($filename)));
            }
        }
    }

    public function actionAddImage($id){

        $model = $this->loadModel($id);
        $userUpload = new UserUpload();

        if(isset($_POST['UserUpload'])){
            $userUpload->parent_id = $model->id;
            $userUpload->attributes = $_POST['UserUpload'];
            if($userUpload->save()){
                $this->redirect('/image/'.$id);
            }
        }

        $this->render('addimage',array('model'=>$userUpload,'image'=>$model));
    }
}
