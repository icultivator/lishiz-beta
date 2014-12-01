<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
    'Images'=>array('index'),
    $image->title=>array('/image/view/'.$image->id),
    'Add',
);

$this->menu=array(
    array('label'=>'View Image','url'=>array('/image/view/'.$image->id)),
    array('label'=>'List Image', 'url'=>array('index')),
    array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1>Add Image</h1>

<?php $this->renderPartial('_add', array('model'=>$model)); ?>
