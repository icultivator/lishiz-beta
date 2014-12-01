<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
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
        <input type="file" id="Book_upload" name="image"/>
        <?php echo $form->hiddenField($model,'cover') ?>
        <?php echo $form->error($model,'cover'); ?>
    </div>
    <div class="preview" id="Book_preview"></div>

    <div class="row">
        <?php echo $form->labelEx($model,'author'); ?>
        <?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'author'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>8, 'cols'=>50)); ?>
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
        <?php echo $form->dropDownList($model,'status',array($model::BOOK_DRAFT=>'草稿',$model::BOOK_PUBLISHED=>'发布')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

    <?php $this->widget('ext.fileupload.MFileUploadWidget',array(
        'id'=>'Book_upload','cover'=>'Book_cover','preview'=>'Book_preview','request'=>'/book/upload'))?>
    <?php $this->widget('ext.editor.MKEditorWidget',array(
        'id'=>'Book_content'))?>
    <?php $this->widget('ext.tagsinput.MTagsWidget',array(
        'id'=>'Book_tags'))?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->