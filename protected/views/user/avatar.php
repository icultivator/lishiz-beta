<?php
/* @var $this UserController */
/* @var $model User */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
    '个人中心'=>array('/user/view/'.$model->id),
    '个人信息',
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

<ul class="user-home-ul">
    <li><?php echo CHtml::link('基本信息','/user/profile/'.$model->id)?></li>
    <li><?php echo CHtml::link('重置密码','/user/profile/'.$model->id.'?opt=repass')?></li>
    <li><?php echo CHtml::link('修改头像','/user/profile/'.$model->id.'?opt=avatar')?></li>
</ul>
<div class="clear"></div>

<div class="user-avatar">

    <input type="file" name="image" id="User_avatar"/>

    <div class="clear"></div>

    <img src="<?php echo MPicManager::getThumbPath($model->avatar,250,250);?>"
         width="<?php echo $arrSize[0]?>" height="<?php echo $arrSize[1];?>"
         style="float: left; margin-right: 10px;" id="thumbnail" alt="头像裁剪"/>

    <div style="float:left; position:relative; overflow:hidden;width: 100px;height:100px;">
        <img src="<?php echo MPicManager::getThumbPath($model->avatar,250,250);?>" id="preview" style="position: relative;" alt="头像预览">
    </div>

    <div class="clear"></div>

    <form name="thumbnail" action="/user/profile/<?php echo $model->id?>?opt=avatar" method="post">

        <input type="hidden" name="avatar" value="<?php echo $model->avatar?>" id="avatar">

        <input type="hidden" name="x1" value="" id="x1">

        <input type="hidden" name="y1" value="" id="y1">

        <input type="hidden" name="x2" value="" id="x2">

        <input type="hidden" name="y2" value="" id="y2">

        <input type="hidden" name="w" value="" id="w">

        <input type="hidden" name="h" value="" id="h">

        <input type="submit" class="button" name="upload_thumbnail" value="保存修改" id="save_thumb">

    </form>

</div>

<?php $this->widget('ext.fileupload.MFileUploadWidget',array(
    'id'=>'User_avatar','avatar'=>'avatar','crop'=>'thumbnail','preview'=>'preview','request'=>'/user/upload'))?>
<?php $this->widget('ext.avatar.MAvatarCropWidget',array(
    'id'=>'User_avatar_crop'))?>