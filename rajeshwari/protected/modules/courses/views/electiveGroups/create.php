<?php
$this->breadcrumbs=array(
	Yii::t('Electives','Elective Groups')=>array('index'),
	Yii::t('Electives','Create'),
);

$this->menu=array(
	array('label'=>'List ElectiveGroups', 'url'=>array('index')),
	array('label'=>'Manage ElectiveGroups', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('Electives','Create Elective Groups'); ?></h1><br />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    
    </td>
  </tr>
</table>