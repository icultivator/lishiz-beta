<h3>Comments</h3>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$comments,
    'itemView'=>'/comment/_view',
)); ?>

<?php $this->renderPartial('/comment/create',array('obj_id'=>$obj_id,'obj_type'=>$obj_type,'post_author'=>$author_id));?>