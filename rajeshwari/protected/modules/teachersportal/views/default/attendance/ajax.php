<?php
$find = StudentAttentance::model()->findAll("date=:x AND student_id=:y", array(':x'=>$year.'-'.$month.'-'.$day,':y'=>$emp_id));
if(count($find)==0)
{
echo CHtml::ajaxLink('ll',$this->createUrl('/teachersportal/default/addnew'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialog123'.$day.$emp_id,'type' =>'GET','data'=>array('day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
        ),array('id'=>'showJobDialog'.$day.$emp_id,'class'=>'at_abs'));
}
else{
	 echo CHtml::ajaxLink('<span class="abs"></span>',$this->createUrl('/teachersportal/default/EditLeave'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialogupdate'.$day.$emp_id,'type' =>'GET','data'=>array('id'=>$find[0]['id'],'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
		
        ),array('id'=>'showJobDialog'.$day.$emp_id,'title'=>'Reason: '.$find['0']['reason']));
}
		

?>