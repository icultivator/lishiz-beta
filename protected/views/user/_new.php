<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>16,'maxlength'=>16)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'pass'); ?>
        <?php echo $form->passwordField($model,'pass',array('size'=>32,'maxlength'=>32)); ?>
        <?php echo $form->error($model,'pass'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'repass'); ?>
        <?php echo $form->passwordField($model,'repass',array('size'=>32,'maxlength'=>32)); ?>
        <?php echo $form->error($model,'repass'); ?>
    </div>

    <p class="hint">
        已有账号？立即<a href="/user/login">登录</a>！
    </p>

    <div class="row buttons">
        <?php echo CHtml::submitButton('注册'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->