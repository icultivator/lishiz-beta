<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'个人中心'=>array('/user/view/'.$model->id),
	'个人信息',
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

<ul class="user-home-ul">
    <li><?php echo CHtml::link('基本信息','/user/profile/'.$model->id)?></li>
    <li><?php echo CHtml::link('重置密码','/user/profile/'.$model->id.'?opt=repass')?></li>
    <li><?php echo CHtml::link('修改头像','/user/profile/'.$model->id.'?opt=avatar')?></li>
</ul>
<div class="clear"></div>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>