<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-form',
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
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intro'); ?>
		<?php echo $form->textArea($model,'intro',array('cols'=>60,'rows'=>5)); ?>
		<?php echo $form->error($model,'intro'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'cover'); ?>
        <input type="file" id="Group_upload" name="image"/>
        <?php echo $form->hiddenField($model,'cover') ?>
        <?php echo $form->error($model,'cover'); ?>
    </div>
    <div class="preview" id="Group_preview"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array($model::GROUP_OFFLINE=>'筹备中...',$model::GROUP_ONLINE=>'上线')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <?php $this->widget('ext.fileupload.MFileUploadWidget',array(
        'id'=>'Group_upload','cover'=>'Group_cover','preview'=>'Group_preview'))?>
    <?php $this->widget('ext.tagsinput.MTagsWidget',array(
        'id'=>'Group_tags'))?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->