<h3>Comments</h3>

<?php $this->renderPartial('/comment/create',
    array('obj_id'=>$obj_id,'obj_type'=>$obj_type,'post_author'=>$author_id));?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$comments,
    'itemView'=>'/comment/_view',
)); ?>

<script type="text/javascript">
    $('.add-sub-comment-link').click(function () {
        $('#comment-parent-id').val($(this).attr('parent_id'));
        $('#comment-to').val($(this).attr('comment_to'));
        var username = $(this).parent('div.view').find('span.comment-author').text();
        $('#comment-area').attr('placeholder','回复'+username+':');
    });
</script>