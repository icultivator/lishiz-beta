<div class="add-comment" id="add-comment">
    <?php echo CHtml::hiddenField('parent_id','0',array('id'=>'comment-parent-id'));?>
    <?php echo CHtml::hiddenField('comment_to',$post_author,array('id'=>'comment-to'));?>
    <?php echo CHtml::textArea('comment','',array('cols'=>60,'rows'=>5,'id'=>'comment-area'))?>
    <?php echo CHtml::ajaxButton('发表','/comment/create',array(
        'type'=>'POST',
        'data'=>array(
            'parent_id'=>'js:$("#comment-parent-id").val()',
            'comment_to'=>'js:$("#comment-to").val()',
            'obj_id'=>$obj_id,
            'obj_type'=>$obj_type,
            'comment'=>'js:$("#comment-area").val()'),
        'dataType'=>'json',
        'success'=>'function(data){
            alert(data.msg);
        }'
    ))?>
</div>
<script type="text/javascript">
    $('.add-sub-comment-link').click(function () {
        alert($(this).attr('comment_to'));
        $('#comment-parent-id').val($(this).attr('parent_id'));
        $('#comment-to').val($(this).attr('comment_to'));
    });
</script>
