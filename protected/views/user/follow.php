<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    '个人中心'=>array('/user/view/'.$model->id),
    '我的关注'
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

<div class="user-follow">
    <ul class="user-home-ul">
        <li><?php echo CHtml::link('用户','/user/'.$route.'/'.$model->id.'?filter=user')?></li>
        <li><?php echo CHtml::link('话题','/user/'.$route.'/'.$model->id.'?filter=topic')?></li>
    </ul>

    <div class="clear"></div>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$follows,
        'itemView'=>'_flow',
    )); ?>

</div>