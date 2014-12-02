<?php
/* @var $this CrawlerController */
/* @var $model Crawler */

$this->breadcrumbs=array(
	'Crawlers'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Crawler', 'url'=>array('index')),
	array('label'=>'Create Crawler', 'url'=>array('create')),
	array('label'=>'View Crawler', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Crawler', 'url'=>array('admin')),
);
?>

<h1>Update Crawler <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>