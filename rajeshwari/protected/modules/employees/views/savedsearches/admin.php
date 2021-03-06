<?php
$this->breadcrumbs=array(
	'Savedsearches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('employees','List Savedsearches'), 'url'=>array('index')),
	array('label'=>Yii::t('employees','Create Savedsearches'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('savedsearches-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('employees','Manage Savedsearches'); ?></h1>

<p>
<?php echo Yii::t('employees','You may optionally enter a comparison operator') ; ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) <?php echo Yii::t('employees','at the beginning of each of your search values to specify how the comparison should be done.') ; ?>
</p>

<?php echo CHtml::link(Yii::t('employees','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'savedsearches-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'url',
		'type',
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
