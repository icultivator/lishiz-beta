<?php
/* @var $this CrawlerController */
/* @var $model Crawler */

$this->breadcrumbs=array(
	'Crawlers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Crawler', 'url'=>array('index')),
	array('label'=>'Manage Crawler', 'url'=>array('admin')),
);
?>

<h1>Create Crawler</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>