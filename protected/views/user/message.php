<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    '个人中心'=>array('/user/view/'.$model->id),
    '我的消息'
);

$this->menu=array(
    array('label'=>'Home', 'url'=>array('/user/'.$model->id)),
    array('label'=>'Follow', 'url'=>array('/user/follow/'.$model->id)),
    array('label'=>'Comment', 'url'=>array('/user/comment/'.$model->id)),
    array('label'=>'Collect', 'url'=>array('/user/collect/'.$model->id)),
    array('label'=>'Vote', 'url'=>array('/user/vote/'.$model->id)),
    array('label'=>'Message', 'url'=>array('/user/message/'.$model->id)),
    array('label'=>'Profile', 'url'=>array('/user/profile/'.$model->id)),
);
?>

<h1>我的消息</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$messages,
    'itemView'=>'_message',
)); ?>