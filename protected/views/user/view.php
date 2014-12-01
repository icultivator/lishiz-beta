<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'个人中心',
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

<h1>我的个人主页</h1>

<div class="header" style="background: #eee;padding: 5px;margin: 5px 0;">
    <?php if($model->intro):?>
        <p><?php echo $model->intro;?></p>
    <?php endif;?>
    等级：<?php echo $model->level;?>
    <?php if(!$model->is_own):?>
    <?php $this->renderPartial('/ajax/follow',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'is_followed'=>$is_followed,'follows'=>$model->getFollowed()))?>
    <?php endif;?>
</div>

<div class="user-flows">
    <ul class="user-home-ul">
        <li><?php echo CHtml::link('全部','/user/'.$route.'/'.$model->id)?></li>
        <li><?php echo CHtml::link('知识库','/user/'.$route.'/'.$model->id.'?filter=post')?></li>
        <li><?php echo CHtml::link('图书','/user/'.$route.'/'.$model->id.'?filter=book')?></li>
        <li><?php echo CHtml::link('视频','/user/'.$route.'/'.$model->id.'?filter=video')?></li>
        <li><?php echo CHtml::link('话题','/user/'.$route.'/'.$model->id.'?filter=topic')?></li>
    </ul>
    <div class="clear"></div>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$flows,
        'itemView'=>'_flow',
    )); ?>
</div>

<div class="footer">

</div>
