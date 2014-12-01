<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">
    <?php if($data->status==UserMessage::MSG_NOT_READ):?>
        <span class="msg-not-read">[未读]</span>
    <?php else:?>
        <span class="msg-read">[已读]</span>
    <?php endif;?>
    <?php echo CHtml::link($data->subject,'/message/view/'.$data->id)?>
    发送于
    <i><?php echo date('Y-m-d H:i:s',$data->send_time);?></i>
</div>