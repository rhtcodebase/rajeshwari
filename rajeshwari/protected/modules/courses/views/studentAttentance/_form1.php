
<div class="formCon" style="width:inherit;">
<div class="formConInner" style="width:50%">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-attentance-form',
	//'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t('attendance','Specify Reason') ?></p>

	<?php echo $form->errorSummary($model); ?>
    <?php echo  CHtml::hiddenField('id',$_REQUEST['id']); ?>

	<div class="row">
		<?php
		 //echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->hiddenField($model,'student_id',array('value'=>$emp_id)); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'date'); ?>
		<?php echo $form->hiddenField($model,'date',array('value'=>$year.'-'.$month.'-'.$day)); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>
    

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
         <?php echo CHtml::ajaxSubmitButton(Yii::t('attendance','Save'),CHtml::normalizeUrl(array('StudentAttentance/EditLeave','render'=>false)),array('success'=>'js: function(data) {
						$("#td'.$day.$emp_id.'").text("");
						$("#jobDialog123'.$day.$emp_id.'").html("<span class=\"abs\"></span>","");
						$("#jobDialog'.$day.$emp_id.'").dialog("close"); window.location.reload();
                    }'),array('id'=>'closeJobDialog'.$day.$emp_id,'name'=>'save')); ?>
      <?php echo CHtml::ajaxSubmitButton(Yii::t('attendance','Delete'),CHtml::normalizeUrl(array('StudentAttentance/DeleteLeave','render'=>false)),array('success'=>'js: function(data) {
		                $("#td'.$day.$emp_id.'").text(" ");
		                $("#jobDialog'.$day.$emp_id.'").dialog("close"); window.location.reload();
                    }'),array('onClick'=>'return confirm("Are you sure?");','id'=>'closeJobDialog1'.$day.$emp_id,'name'=>'delete')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->