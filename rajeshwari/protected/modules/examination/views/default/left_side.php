<script>
$(document).ready(function() {
	

            //Hide the second level menu
            $('#othleft-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });
</script>

<div id="othleft-sidebar">
<!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>-->
<!--<a href="#enroll_process" id="enroll_p" class="menu_0">Set grading levels<span>Manage your Dashboard</span></a>-->
             <h1><?php echo Yii::t('examination','Exam Management');?></h1>       
                    <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}
         
		  
		  
		  if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL)
		  {
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.Yii::t('examination','Set grading levels').'<span>'.Yii::t('examination','Grading Levels for the batch').'</span>', 'url'=>array('/examination/gradingLevels','id'=>$_REQUEST['id'],) ,'linkOptions'=>array('id'=>'enroll_p','class'=>'gs_ico'),
                                   'active'=> ((Yii::app()->controller->id=='gradingLevels') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						                                
					
					
						array('label'=>Yii::t('examination','Select Course-Batch').'<span>'.Yii::t('examination','Select batch and exam').'</span>', 'url'=>array('/examination/exam','id'=>$_REQUEST['id']),'linkOptions'=>array('class'=>'ne_ico'),'active'=> ((Yii::app()->controller->id=='exam') && (in_array(Yii::app()->controller->action->id,array('index'))) or (Yii::app()->controller->id=='exams') )  ? true : false),
						
						
						/*array('label'=>t('Connect Exams<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('/exam&id=3'),
							'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('class'=>'messgnew_ico')),
		 
						array('label'=>''.t('Additional Exams<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ), 
							array('label'=>''.t('Exam Wise Report<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.t('Subject wise Report<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.t('Grouped exam Reports<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.t('Archived Student Reports<span>Lorem ipsum dolor sit amet,</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),*/
					
						
					
					
				),
			));?>
			
            <?php 

		  }
		  else
		  {
			?>
<ul>
<li>
<?php echo CHtml::ajaxLink(Yii::t('examination','Set grading levels').'<span>'.Yii::t('examination','Grading Levels for the batch').'</span>',array('/site/explorer','widget'=>'2','rurl'=>'examination/gradingLevels'),array('update'=>'#explorer_handler'),array('id'=>'explorer_gradingLevels','class'=>'gs_ico')); ?>
</li>



<li>
<?php echo CHtml::ajaxLink(Yii::t('examination','Select Course-Batch').'<span>'.Yii::t('examination','Select batch and exam').'</span>',array('/site/explorer','widget'=>'2','rurl'=>'examination/exam'),array('update'=>'#explorer_handler'),array('id'=>'explorer_exam','class'=>'ne_ico')); ?>

</li>
</ul>

		 <?php  } 
		 //echo CHtml::ajaxLink('Explorer',array('/site/explorer'),array('update'=>'#explorer_handler'));
		 ?>
		  
		  
          
		</div>
        
    
    
    <?php
/*Yii::app()->clientScript->registerScript('ajax-link-handler', "
$('body').on('click', '#ajax-updated-region a', function(event){
        $.ajax({
                'type':'get',
                'url':$(this).attr('href'),
                'dataType': 'html',
                'success':function(data){
                        $('#ajax-updated-region').html(data);
                }
        });
        event.preventDefault();
});
");*/
?><div id="ajax-updated-region">
<?php //echo CHtml::link("name", array('/site/manage', 'xxx' => '', 'yyy' => '')); ?>
<?php //echo CHtml::link("number", array('/site/manage', 'xxx' => '', 'zzz' => '')); ?>
</div>
   

<!--<div id="enroll_process" style="display:none">

<script language="javascript">
function batch()
{
	var id= document.getElementById('batchdrop').value;
	window.location ='index.php?r=batches/batchstudents&id='+id;
}
</script>-->
<?php /*?><?php $data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'-Select-',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Weekdays/batch'),
'update'=>'#batchdrop',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Batch';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
 ?>
        
		<?php echo CHtml::dropDownList('batch_id','batch_id',$data1,array('empty'=>'-Select-','onchange'=>'batch()','id'=>'batchdrop')); ?><?php */?>

        <!--</div>-->
       
