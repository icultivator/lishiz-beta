<div class="view">

    <b><?php echo CHtml::encode($data->user->name); ?></b>
    在
    <i><?php echo date('Y-m-d H:i:s',$data->comment_time)?></i>
    发表评论说:<br />
    <?php echo CHtml::encode($data->content); ?>
    <br />
    <?php echo CHtml::link('回复','#add-comment',array(
        'class'=>'add-sub-comment-link','parent_id'=>$data->id,'comment_to'=>$data->user_id));?>
</div>

<?php
    foreach($data->subs as $subcomment):
?>
        <div class="view sub-view" style="margin-left: 15px;">

            <b><?php echo CHtml::encode($subcomment->user->name); ?></b>
            在
            <i><?php echo date('Y-m-d H:i:s',$subcomment->comment_time)?></i>
            回复
            <b><?php echo $subcomment->commented->name;?></b>
            说:<br />
            <?php echo CHtml::encode($subcomment->content); ?>
            <br />
            <?php echo CHtml::link('回复','#add-comment',array(
                'class'=>'add-sub-comment-link',
                'parent_id'=>$data->id,
                'comment_to'=>$subcomment->user_id));?>
        </div>
<?php endforeach;?>
