<div class="view">

    <span class="comment-author"><?php echo CHtml::encode($data->user->name); ?></span>
    在
    <i><?php echo date('Y-m-d H:i:s',$data->comment_time)?></i>
    发表评论说:<br />
    <?php echo CHtml::encode($data->content); ?>
    <br />
    <?php $this->renderPartial('/ajax/vote',
        array('obj_id'=>$data->id,'obj_type'=>ObjType::ITEM_COMMENT,'votes'=>$data->votes,'is_voted'=>$data->isVoted()))?>
    <?php echo CHtml::link('回复','#add-comment',array(
        'class'=>'add-sub-comment-link','parent_id'=>$data->id,'comment_to'=>$data->user_id));?>
</div>

<?php
    foreach($data->subs as $subComment):
?>
        <div class="view sub-view" style="margin-left: 15px;">

            <span class="comment-author"><?php echo CHtml::encode($subComment->user->name); ?></span>
            在
            <i><?php echo date('Y-m-d H:i:s',$subComment->comment_time)?></i>
            回复
            <span class="comment-to"><?php echo $subComment->commented->name;?></span>
            说:<br />
            <?php echo CHtml::encode($subComment->content); ?>
            <br />
            <?php $this->renderPartial('/ajax/vote',
                array('obj_id'=>$subComment->id,'obj_type'=>ObjType::ITEM_COMMENT,'votes'=>$subComment->votes,'is_voted'=>$subComment->isVoted()))?>
            <?php echo CHtml::link('回复','#add-comment',array(
                'class'=>'add-sub-comment-link',
                'parent_id'=>$data->id,
                'comment_to'=>$subComment->user_id));?>
        </div>
<?php endforeach;?>
