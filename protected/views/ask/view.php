<?php
/* @var $this AskController */
/* @var $model Ask */

$this->breadcrumbs=array(
	'Asks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ask', 'url'=>array('index')),
	array('label'=>'Create Ask', 'url'=>array('create')),
	array('label'=>'Update Ask', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ask', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ask', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->question; ?></h1>

<div class="header" style="background: #eee;padding: 5px;margin: 5px 0;">
    <b><?php echo $model->user->name?></b>
    于
    <i><?php echo date('Y-m-d H:i:s',$model->create_time);?></i>
    提问，
    <b><?php echo $model->views?></b>
    次浏览,
    <b><?php echo $model->votes?></b>
    人点赞,
    <b><?php echo $model->answers?></b>
    人回答,
</div>

<?php if($model->desc):?>
<div class="content">
    <?php echo $model->desc;?>
</div>
<?php endif;?>

<div class="footer" style="background: #eee;padding: 5px;margin: 5px 0;">
    标签：<?php echo $model->tags;?>
</div>

<div class="answers" id="answers">
    <?php $this->renderPartial('/comment/index',
        array('comments'=>$comments,'obj_id'=>$model->id,'obj_type'=>$obj_type,'author_id'=>$model->user_id))?>
</div>