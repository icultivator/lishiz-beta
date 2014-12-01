<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Update Group', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<h1>#<?php echo $model->name; ?></h1>

<div class="desc">
    <p class="hint"><?php echo $model->intro;?></p>
</div>

<div class="info" style="background: #eee;padding: 5px;">
    本小组诞生于<i><?php echo date('Y-m-d',$model->create_time);?></i>,
    至今已经拥有<b class="member-nums"><?php echo $model->members;?></b>名会员。
    <?php echo CHtml::ajaxLink('关注','/group/follow',array(
        'type'=>'POST',
        'data'=>array('group_id'=>$model->id),
        'dataType'=>'json',
        'success'=>'function(data){
            if(data.success){
                $(".member-nums").html(data.members);
            }else{
                alert(data.msg);
            }
        }'
    ))?>
</div>

<div class="topics" style="margin-top: 15px;">
    <?php $this->renderPartial('/topic/index',array('dataProvider'=>$topics));?>
</div>

<div class="create-topic" style="margin-top: 15px;">
    <a href="/topic/create/<?php echo $model->id;?>">创建话题</a>
</div>
