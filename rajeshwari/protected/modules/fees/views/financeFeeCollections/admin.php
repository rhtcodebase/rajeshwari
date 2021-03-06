<?php
$this->breadcrumbs=array(
	'Finance Fee Collections'=>array('/fees'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('fees','List FinanceFeeCollections'), 'url'=>array('index')),
	array('label'=>Yii::t('fees','Create FinanceFeeCollections'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('finance-fee-collections-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('fees','Manage Finance Fee Collections');?></h1>

<p>
<?php echo Yii::t('fees','You may optionally enter a comparison operator') ; ?> (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) <?php echo Yii::t('fees','at the beginning of each of your search values to specify how the comparison should be done.') ; ?>
</p>

<?php echo CHtml::link(Yii::t('fees','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'finance-fee-collections-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'start_date',
		'end_date',
		'due_date',
		'fee_category_id',
		/*
		'batch_id',
		'is_deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
