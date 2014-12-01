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

<div class="form" style="margin-top:15px;">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'oldpass'); ?>
        <?php echo $form->passwordField($model,'oldpass',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'oldpass'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::label('新密码','User_newpass'); ?>
        <?php echo $form->passwordField($model,'newpass',array('size'=>16,'maxlength'=>16,'value'=>'')); ?>
        <?php echo $form->error($model,'newpass'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'repass'); ?>
        <?php echo $form->passwordField($model,'repass',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'repass'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->