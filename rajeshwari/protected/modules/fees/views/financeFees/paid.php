<?php
$this->breadcrumbs=array(
	'Finance Fees'=>array('/fees'),
	
);?>
<script language="javascript">
function batch()
{
var id = document.getElementById('batch').value;
window.location= 'index.php?r=fees/financeFees/paid&batch='+id;	
}
function category()
{
var id_1 = document.getElementById('batch').value;
var id = document.getElementById('category').value;
window.location= 'index.php?r=fees/financeFees/paid&batch='+id_1+'&course='+id;	
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <h1><?php echo Yii::t('fees','Paid Students');?></h1>
    <div class="formCon" style="padding:3px;">
    <div class="formConInner" style="padding:3px 10px;">
    <table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>

    <?php 

$data = CHtml::listData(Batches::model()->findAll("is_active=:x and is_deleted=:y ORDER BY start_date DESC", array(':x'=>1,':y'=>0)),'id','coursename');
if(isset($_REQUEST['batch']))
{
	$sel= $_REQUEST['batch'];
}
else
{
	$sel='';
}
echo '<span style="font-size:14px; font-weight:bold; color:#666;">'.Yii::t('fees','Batch').'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
echo CHtml::dropDownList('id','',$data,array('prompt'=>'Select','onchange'=>'batch()','id'=>'batch','options'=>array($sel=>array('selected'=>true)))); 
echo '</td><td style="padding-top:13px;">';
?>

<?php
$data_1 = array();
if(isset($_REQUEST['batch']))
{
	$data_1 = CHtml::listData(FinanceFeeCollections::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['batch'])),'id','name');
	
	
}
if(isset($_REQUEST['course']))
	{
		$sel_1= $_REQUEST['course'];
	}	
	else
	{
	$sel_1 = '';	
	}
echo '<span style="font-size:14px; font-weight:bold; color:#666;">'.Yii::t('fees','Collection').' </span>&nbsp;&nbsp;&nbsp;&nbsp;';
echo CHtml::dropDownList('id','',$data_1,array('prompt'=>'Select','onchange'=>'category()','id'=>'category','options'=>array($sel_1=>array('selected'=>true)))); 
echo '<br/><br/>';


?>


    <td>
     </tr>
</table>
</div></div>
<?php if(isset($_REQUEST['batch']) && isset($_REQUEST['course']))
{ 
$collection = FinanceFeeCollections::model()->findByAttributes(array('id'=>$_REQUEST['course']));
//$particular = FinanceFeeParticulars::model()->findByAttributes(array('finance_fee_category_id'=>$collection->fee_category_id));
$particular = FinanceFeeParticulars::model()->findAll("finance_fee_category_id=:x", array(':x'=>$collection->fee_category_id));
$currency=Configurations::model()->findByPk(5);
$student_category_list=Yii::app()->db->createCommand('select id,name from student_categories')->queryAll();
                $categ=array();
                foreach ($student_category_list as $stu_cat) {
                    $categ[$stu_cat["id"]]=$stu_cat["name"];
                }

if(count($particular)!=0)
{
	//$amount = 0;

	$list  = FinanceFees::model()->findAll("fee_collection_id=:x and is_paid=:y", array(':x'=>$_REQUEST['course'],':y'=>1));
	
	?>

<div class="tableinnerlist"> 
		<div class="ea_pdf" style="top:6px; right:1px;"><?php echo CHtml::link('<img src="images/pdf-but.png" border="0" />', array('/fees/FinanceFees/paidpdf','batch'=>$_REQUEST['batch'],'collection'=>$_REQUEST['course']),array('target'=>"_blank")); ?></div>
        <?php 
		$i = 1;
			foreach($particular as $particular_1) { ?>
       
        <?php  /*$amount = $amount + $particular_1->amount;*/ $i++;} ?>
         <br />
       <table width="80%" cellspacing="0" cellpadding="0">
        <tr>
         <th><strong><?php echo Yii::t('fees','Sl no.');?> </strong></th>
         <th><strong><?php echo Yii::t('fees','Student Name');?></strong></th>
         <th><strong><?php echo Yii::t('fees','Category');?></strong></th>
         <th><strong><?php echo Yii::t('fees','Fees');?></strong></th>
         <th><strong><?php echo Yii::t('fees','Action');?></strong></th>
        </tr> 
       <?php 
	   if(count($list)>0){
	   $i= 1;
	   foreach($list as $list_1) { ?> 
        <tr>
         <td><?php echo $i; ?></td>
         <td><?php 
		 $posts=Students::model()->findByAttributes(array('id'=>$list_1->student_id));
		 echo $posts->first_name; ?></td>
	 <td><?php echo $categ[$posts->student_category_id];?></td>
         <td>
		 	<?php
				$check_admission_no = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$collection->fee_category_id,'admission_no'=>$posts->admission_no));
				if(count($check_admission_no)>0){ // If any particular is present for this student
					$adm_amount = 0;
					foreach($check_admission_no as $adm_no){
						$adm_amount = $adm_amount + $adm_no->amount;
					}
					echo $currency->config_value.' '.$adm_amount;	
				}
				else{ // If any particular is present for this student category
					$check_student_category = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$collection->fee_category_id,'student_category_id'=>$posts->student_category_id,'admission_no'=>''));
					if(count($check_student_category)>0){
						$cat_amount = 0;
						foreach($check_student_category as $stu_cat){
							$cat_amount = $cat_amount + $stu_cat->amount;
						}
						echo $currency->config_value.' '.$cat_amount;		
					}
					else{ //If no particular is present for this student or student category
						$check_all = FinanceFeeParticulars::model()->findAllByAttributes(array('finance_fee_category_id'=>$collection->fee_category_id,'student_category_id'=>NULL,'admission_no'=>''));
						if(count($check_all)>0){
							$all_amount = 0;
							foreach($check_all as $all){
								$all_amount = $all_amount + $all->amount;
							}
							echo $currency->config_value.' '.$all_amount;
						}
						else{
							echo '-'; // If no particular is found.
						}
					}
				}
				
			 
			?>
         </td>
        <td><?php echo CHtml::link('Print Receipt',array('/fees/FinanceFees/printreceipt','batch'=>$_REQUEST['batch'],'collection'=>$_REQUEST['course'],'id'=>$posts->id),array('target'=>'_blank')); ?></td> 
        
        
        </tr>   
        
    
    <?php $i++; } 
	   }
	   else{
	   ?>
  		<tr>
          <td colspan="5"><?php echo Yii::t('students','No students paid the fees.');?></td>             
        </tr>
        <?php 
	   }
	   ?>
    </table>
</div>


<?php 
	
}
?>



<?php } ?>

    
    
    </div>
    </td>
  </tr>
</table>
