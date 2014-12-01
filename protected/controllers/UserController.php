<?php

class UserController extends Controller
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
				'actions'=>array('index','view','login','register','flow','collect','vote','follow','comment'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','logout','message','profile'),
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
		$this->actionFlow($id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionRegister(){
        $model = new User('register');
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('register',array(
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if(!Yii::app()->user->isGuest){
            $this->redirect('/site/index');
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    //时间流
    public function actionFlow($id){
        $model = $this->loadModel($id);
        if(isset($_GET['filter'])){
            $filter = trim($_GET['filter']);
            if($filter && isset(Yii::app()->params['obj_type'][$filter])){
                $obj_type = Yii::app()->params['obj_type'][$filter];
            }
        }
        $criteria = new CDbCriteria();
        $opt_type = '('.Yii::app()->params['opt_type']['create'].','.Yii::app()->params['opt_type']['update'].')';
        if(!Yii::app()->user->isGuest || Yii::app()->user->id != $model->id){
            if(isset($obj_type)){
                $criteria->condition = 'obj_status=:status AND user_id = :uid AND obj_type = :type AND opt_type IN '.$opt_type;
                $criteria->params = array(':status'=>1,':uid'=>$model->id,':type'=>$obj_type);
            }else{
                $criteria->condition = 'obj_status=:status AND user_id = :uid AND opt_type IN '.$opt_type;
                $criteria->params = array(':status'=>1,':uid'=>$model->id);
            }
        }elseif(Yii::app()->user->id == $model->id){
            if(isset($obj_type)){
                $criteria->condition = 'user_id = :uid AND obj_type = :type AND opt_type IN '.$opt_type;
                $criteria->params = array(':uid'=>$model->id,':type'=>$obj_type);
            }else{
                $criteria->condition = 'user_id = :uid AND opt_type IN '.$opt_type;
                $criteria->params = array(':uid'=>Yii::app()->user->id);
            }
        }

        $criteria->order = 'log_time DESC';
        $flows = new CActiveDataProvider('UserFlow',array('criteria'=>$criteria));

        $is_followed = UserFollow::model()->isFollowed($model->id,$model->obj_type);

        $this->render('view',array('flows'=>$flows,'model'=>$model,'route'=>'flow','is_followed'=>$is_followed));
    }

    //收藏
    public function actionCollect($id){
        $model = $this->loadModel($id);
        if(isset($_GET['filter'])){
            $filter = trim($_GET['filter']);
            if($filter && isset(Yii::app()->params['obj_type'][$filter])){
                $obj_type = Yii::app()->params['obj_type'][$filter];
            }
        }
        $opt_type = Yii::app()->params['opt_type']['collect'];
        $criteria = new CDbCriteria();
        if(isset($obj_type)){
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND obj_type = :type1 AND opt_type=:type2';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type1'=>$obj_type,':type2'=>$opt_type);
        }else{
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND opt_type=:type';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type'=>$opt_type);
        }
        $criteria->order = 'log_time DESC';
        $collects = new CActiveDataProvider('UserFlow',array('criteria'=>$criteria));
        $this->render('collect',array('collects'=>$collects,'model'=>$model,'route'=>'collect'));
    }

    //关注
    public function actionFollow($id){
        $model = $this->loadModel($id);
        if(isset($_GET['filter'])){
            $filter = trim($_GET['filter']);
            if($filter && isset(Yii::app()->params['obj_type'][$filter])){
                $obj_type = Yii::app()->params['obj_type'][$filter];
            }
        }
        $opt_type = Yii::app()->params['opt_type']['follow'];
        $criteria = new CDbCriteria();
        if(isset($obj_type)){
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND obj_type = :type1 AND opt_type=:type2';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type1'=>$obj_type,':type2'=>$opt_type);
        }else{
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND opt_type=:type';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type'=>$opt_type);
        }
        $criteria->order = 'log_time DESC';
        $follows = new CActiveDataProvider('UserFlow',array('criteria'=>$criteria));
        $this->render('follow',array('follows'=>$follows,'model'=>$model,'route'=>'follow'));
    }

    //点赞
    public function actionVote($id){
        $model = $this->loadModel($id);
        if(isset($_GET['filter'])){
            $filter = trim($_GET['filter']);
            if($filter && isset(Yii::app()->params['obj_type'][$filter])){
                $obj_type = Yii::app()->params['obj_type'][$filter];
            }
        }
        $opt_type = Yii::app()->params['opt_type']['vote'];
        $criteria = new CDbCriteria();
        if(isset($obj_type)){
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND obj_type = :type1 AND opt_type=:type2';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type1'=>$obj_type,':type2'=>$opt_type);
        }else{
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND opt_type=:type';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type'=>$opt_type);
        }
        $criteria->order = 'log_time DESC';
        $votes = new CActiveDataProvider('UserFlow',array('criteria'=>$criteria));
        $this->render('vote',array('votes'=>$votes,'model'=>$model,'route'=>'vote'));
    }

    //评论
    public function actionComment($id){
        $model = $this->loadModel($id);
        if(isset($_GET['filter'])){
            $filter = trim($_GET['filter']);
            if($filter && isset(Yii::app()->params['obj_type'][$filter])){
                $obj_type = Yii::app()->params['obj_type'][$filter];
            }
        }
        $opt_type = Yii::app()->params['opt_type']['comment'];
        $criteria = new CDbCriteria();
        if(isset($obj_type)){
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND obj_type = :type1 AND opt_type=:type2';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type1'=>$obj_type,':type2'=>$opt_type);
        }else{
            $criteria->condition = 'obj_status=:status AND user_id = :uid AND opt_type=:type';
            $criteria->params = array(':status'=>1,':uid'=>$model->id,':type'=>$opt_type);
        }
        $criteria->order = 'log_time DESC';
        $comments = new CActiveDataProvider('UserFlow',array('criteria'=>$criteria));
        $this->render('comment',array('comments'=>$comments,'model'=>$model,'route'=>'comment'));
    }

    //消息
    public function actionMessage($id){
        if(Yii::app()->user->id != $id){
            throw new CHttpException('403');
            exit;
        }
        $model = $this->loadModel($id);
        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :uid';
        $criteria->params = array(':uid'=>Yii::app()->user->id);
        $criteria->order = 'send_time DESC';
        $messages = new CActiveDataProvider('UserMessage',array('criteria'=>$criteria));
        $this->render('message',array('messages'=>$messages,'model'=>$model));
    }

    public function actionProfile($id){
        if(!isset($_GET['opt'])){
            $this->actionUpdate($id);
            exit;
        }

        if(isset($_GET['opt'])&&$_GET['opt']=='repass'){
            $model = $this->loadModel($id);
            $model->setScenario('repass');
            if(isset($_POST['User'])){
                $model->attributes=$_POST['User'];
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
            $this->render('repass',array('model'=>$model));
            exit;
        }

        if(isset($_GET['opt'])&&$_GET['opt']=='avatar'){
            $model = $this->loadModel($id);
            $model->setScenario('avatar');
            $this->render('avatar',array('model'=>$model));
            exit;
        }

        throw new CHttpException('404');

    }
}
