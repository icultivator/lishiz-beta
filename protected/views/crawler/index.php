<?php
/* @var $this CrawlerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crawlers',
);

$this->menu=array(
	array('label'=>'Create Crawler', 'url'=>array('create')),
	array('label'=>'Manage Crawler', 'url'=>array('admin')),
);
?>

<h1>Crawlers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
