<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Users'=>array('index'),
    'Register',
);

$this->menu=array(
    array('label'=>'List User', 'url'=>array('index')),
    array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Register User</h1>

<?php $this->renderPartial('_new', array('model'=>$model)); ?>