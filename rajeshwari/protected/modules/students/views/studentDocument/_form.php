<script>
	function addRow(tableID) 
	{
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if(rowCount < 23)// limit the user from creating fields more than your limits
		{
			var row = table.insertRow(rowCount);
			var colCount = table.rows[0].cells.length;
			for(var i=0; i<colCount; i++) 
			{
				var newcell = row.insertCell(i);
				newcell.innerHTML = "&nbsp;";
			}   
			rowCount++;                     
			for(var j=0; j<2; j++)
			{
				var row = table.insertRow(rowCount);
				var colCount = table.rows[j].cells.length;
				for(var i=0; i<colCount; i++) 
				{
					var newcell = row.insertCell(i);
					newcell.innerHTML = table.rows[j].cells[i].innerHTML;
				}
				rowCount++;
			}
			addDiv("student_id");
			addDiv("file_type");
			addDiv("created_at");
		}
		else
		{
			 alert("Only 8 files can be uploaded at a time. Go to the student profile to add more.");
		}				   
/* Quickfix*/	

$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").unbind('change');
$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").change(function(){
	tr = $(this).closest('tr');
	text = tr.find("input[type=text]");
	 filename = $(this).val().split('\\').pop();
	 text.attr("value", filename);
});

$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").each(function(){
	tr = $(this).closest('tr');
	text = tr.find("input[type=text]");
	 if($(this).val()==""){
           	 text.attr("value", "");
         }

});

/* Quickfix end*/
	}
	
	function addDiv(divID)
	{
		var divTag = document.createElement("div");
		divTag.className = "row";
		divTag.innerHTML = document.getElementById(divID).innerHTML;
		document.getElementById("innerDiv").appendChild(divTag);
	}

		$(document).ready(function(){  
		/* Quickfix*/		
		$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").unbind('change');
		$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").change(function(){
			tr = $(this).closest('tr');
			text = tr.find("input[type=text]");
			 filename = $(this).val().split('\\').pop();
			 text.attr("value", filename);
		});
		
		$("input[name=StudentDocument\\[file\\]\\[\\]][type=file]").each(function(){
			tr = $(this).closest('tr');
			text = tr.find("input[type=text]");
			 if($(this).val()==""){
		           	 text.attr("value", "");
		         }
		
		});
		
		});
</script>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>CController::createUrl('studentDocument/create')
)); ?>

	<?php 
		if($form->errorSummary($model)){
	?>
        <div class="errorSummary">Input Error<br />
        	<span>Please fix the following error(s).</span>
        </div>
    <?php 
		}
		if(Yii::app()->controller->action->id!="document")
        {
	?>
    
  	<p class="note" style="float:left">Fields with <span class="required">*</span> are required.</p>
    
    
    <?php
	
	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$(".error").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	   CClientScript::POS_READY
	);
	?>
	<?php
	if(Yii::app()->user->hasFlash('errorMessage')): 
	?>
	<div class="error" style="background:#FFF; color:#C00; padding-left:200px; top:150px;">
		<?php echo Yii::app()->user->getFlash('errorMessage'); ?>
	</div>
	<?php
	endif;
		}
	?>

    <div class="formCon" style="clear:left;">
        <div class="formConInner" id="innerDiv">
        	<table width="80%" border="0" cellspacing="0" cellpadding="0" id="documentTable">
            	<tr>
                	<td><?php echo $form->labelEx($model,Yii::t('students','Document Name')); ?></td>
                    <td><?php echo $form->labelEx($model,Yii::t('students','file')); ?></td>
                </tr>
                <tr>
                	<td>
						<?php echo $form->textField($model,'title[]',array('size'=>25,'maxlength'=>225)); ?>
                         <?php echo $form->error($model,'title'); ?>
                    </td>
                    <td>
						<?php echo $form->fileField($model,'file[]'); ?>
                        <?php echo $form->error($model,'file'); ?>
                    </td>
                    
                </tr>
            </table>
            <?php
            if(Yii::app()->controller->action->id=="document")
            {
			?>
            <div class="row">
                <?php echo $form->hiddenField($model,'document',array('value'=>1)); ?>
                <?php echo $form->error($model,'document'); ?>    
            </div>
			<?php  
			}
			?>
            <div class="row">
                <?php echo $form->hiddenField($model,'sid',array('value'=>$_REQUEST['id'])); ?>
                <?php echo $form->error($model,'sid'); ?>    
            </div>
			
            <div class="row" id="student_id">
                <?php echo $form->hiddenField($model,'student_id[]',array('value'=>$_REQUEST['id'])); ?>
                <?php echo $form->error($model,'student_id'); ?>
            </div>
        
            <div class="row" id="file_type">
                <?php //echo $form->labelEx($model,'file_type'); ?>
                <?php echo $form->hiddenField($model,'file_type[]'); ?>
                <?php echo $form->error($model,'file_type'); ?>
            </div>
        
            <div class="row" id="created_at">
                <?php //echo $form->labelEx($model,'created_at'); ?>
                <?php echo $form->hiddenField($model,'created_at[]'); ?>
                <?php echo $form->error($model,'created_at'); ?>
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::button('Add Another', array('class'=>'formbut','id'=>'addAnother','onclick'=>'addRow("documentTable");')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'SAVE' : 'Save',array('class'=>'formbut')); ?>
    </div>
    	

<?php $this->endWidget(); ?>

</div><!-- form -->
