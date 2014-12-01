<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'cover'); ?>
        <input type="file" id="Post_upload" name="image"/>
        <?php echo $form->hiddenField($model,'cover') ?>
        <?php echo $form->error($model,'cover'); ?>
    </div>
    <div class="preview" id="Post_preview"></div>

    <div class="row">
        <?php echo $form->labelEx($model,'cover_in_post'); ?>
        <?php echo $form->checkBox($model,'cover_in_post'); ?>
        <?php echo $form->error($model,'cover_in_post'); ?>
    </div>

    <div class="row">
        <a href="javascript:void(0);" id="show-summary">摘要</a>
    </div>
	<div class="row summary" style="display: none;">
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>60)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>15, 'cols'=>60)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array($model::POST_DRAFT=>'草稿',$model::POST_PUBLISHED=>'发布')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <?php $this->widget('ext.fileupload.MFileUploadWidget',array(
        'id'=>'Post_upload','cover'=>'Post_cover','preview'=>'Post_preview','request'=>'/post/upload'))?>
    <?php $this->widget('ext.editor.MKEditorWidget',array(
        'id'=>'Post_content'))?>
    <?php $this->widget('ext.tagsinput.MTagsWidget',array(
        'id'=>'Post_tags'))?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $("#show-summary").click(function(){
        $('.summary').toggle();
    });
</script>