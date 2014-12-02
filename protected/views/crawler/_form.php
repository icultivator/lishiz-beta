<?php
/* @var $this CrawlerController */
/* @var $model Crawler */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crawler-form',
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
        <?php echo $form->labelEx($model,'target'); ?>
        <?php echo $form->dropDownList($model,'target',array(ObjType::ITEM_POST=>'知识库',ObjType::ITEM_IMAGE=>'图片',
            ObjType::ITEM_BOOK=>'图书',ObjType::ITEM_VIDEO=>'视频')); ?>
        <?php echo $form->error($model,'target'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'list'); ?>
        <?php echo $form->textArea($model,'list',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'list'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail'); ?>
        <?php echo $form->textArea($model,'detail',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail_title'); ?>
        <?php echo $form->textArea($model,'detail_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detail_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail_content'); ?>
        <?php echo $form->textArea($model,'detail_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detail_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail_cover'); ?>
        <?php echo $form->textArea($model,'detail_cover',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detail_cover'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detail_tags'); ?>
        <?php echo $form->textArea($model,'detail_tags',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detail_tags'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->