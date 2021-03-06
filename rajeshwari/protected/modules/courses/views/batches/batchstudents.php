<style>
.container
{
    background:#FFF;
}
</style>

<?php
$this->breadcrumbs=array(
    Yii::t('Batch','Courses') =>array('/courses'),
    Yii::t('Batch','Batches'),
);
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery');

         //IMPORTANT about Fancybox.You can use the newest 2.0 version or the old one
        //If you use the new one,as below,you can use it for free only for your personal non-commercial site.For more info see
        //If you decide to switch back to fancybox 1 you must do a search and replace in index view file for "beforeClose" and replace with 
        //"onClosed"
        // http://fancyapps.com/fancybox/#license
          // FancyBox2
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css', 'screen');
         // FancyBox
         //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.js', CClientScript::POS_HEAD);
         // Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.css','screen');
        //JQueryUI (for delete confirmation  dialog)
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/js/jquery-ui-1.8.12.custom.min.js', CClientScript::POS_HEAD);
         Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css','screen');
          ///JSON2JS
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/json2/json2.js');
       

           //jqueryform js
               Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/form_ajax_binding.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/client_val_form.css','screen');  ?>
              <?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>


<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
          
<div style="background:#FFF;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
   
    <td valign="top">
    <?php if($batch!=NULL)
           {
               ?>
    <div style="padding:20px;">
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('tab');?>
    
    <div class="clear"></div>
    <div class="emp_cntntbx" style="padding-top:10px;">
    <div class="c_subbutCon" align="right" style="width:100%; height:40px; position:relative">
    <div class="edit_bttns" style="top:0px; right:-6px">
    <ul>
    <div class="ea_pdf" style="top:1px; right:150px;"><?php echo CHtml::link('<img src="images/pdf-but.png" border="0" />', array('batches/batchstudentspdf','id'=>$_REQUEST['id']),array('target'=>"_blank")); ?></div>
    <li>
    <?php echo CHtml::link('<span>'.Yii::t('Batch','Add Student').'</span>', array('/students/students/create','bid'=>$_REQUEST['id']),array('class'=>'addbttn last'));?>
    </li>
    </ul>
    <div class="clear"></div>
    </div>
    </div>
    <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info" style="color:#C30; width:800px; height:30px">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php endif; ?>
    <div class="table_listbx">
     <?php
                if(isset($_REQUEST['id']))
                {
                $posts=Students::model()->findAll("batch_id=:x and is_deleted=:y and is_active=:z", array(':x'=>$_REQUEST['id'],':y'=>'0',':z'=>'1'));
                $student_category_list=Yii::app()->db->createCommand('select id,name from student_categories')->queryAll();
                $categ=array();
                foreach ($student_category_list as $stu_cat) {
                    $categ[$stu_cat["id"]]=$stu_cat["name"];
                }
                if($posts!=NULL)
                {
                ?>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr class="listbxtop_hdng">
                    <td ><?php echo Yii::t('Batch','Sl no.');?></td>
                    <td ><?php echo Yii::t('Batch','Student Name');?></td>
                    <td ><?php echo Yii::t('Batch','Admission Number');?></td>
                    <td ><?php echo Yii::t('Batch','Category');?></td>
                    <td ><?php echo Yii::t('Batch','Gender');?></td>
                    <td ><?php echo Yii::t('Batch','Parent/Guardian Name');?></td>
                    <td ><?php echo Yii::t('Batch','Contact');?></td>
                    <td ><?php echo Yii::t('Batch','Actions');?></td>
                    
                    </tr>
                        <?php
                        $i=0;
                            foreach($posts as $posts_1)
                            {
                                $i++;
                                echo '<tr>';
                                echo '<td>'.$i.'</td>'; 
                                echo '<td>'.CHtml::link(ucfirst($posts_1->first_name).' '.ucfirst($posts_1->middle_name).' '.ucfirst($posts_1->last_name), array('/students/students/view', 'id'=>$posts_1->id)).'</td>';
                                echo '<td>'.$posts_1->admission_no.'</td>';
                                echo '<td>'.$categ[$posts_1->student_category_id].'</td>';?>
                                <td><?php
                                  if($posts_1->gender=='M')
                                  {
                                      echo Yii::t('Batch','Male');
                                  }
                                  elseif($posts_1->gender=='F')
                                  {
                                      echo Yii::t('Batch','Female');
                                  }?></td>
                                 <?php
                                        $guardian=Guardians::model()->findAll("id=:x", array(':x'=>$posts_1->parent_id));
                                ?>
                                <td>
                                    <?php
                                        if($guardian &&$guardian[0]->first_name&& $guardian[0]->first_name!=""){
                                            echo $guardian[0]->first_name;
                                        }
                                        else{
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                  <td>
                                    <?php
                                        if($guardian &&$guardian[0]->mobile_phone && $guardian[0]->mobile_phone!=""){
                                            echo $guardian[0]->mobile_phone;
                                        }
                                        else{
                                            echo '-';
                                        }
                                    ?>
                                </td>  
                                <td >
                                <div style="position:absolute;">
                                <div  id="<?php echo $i; ?>" class="act_but"><?php echo Yii::t('Batch','Actions');?></div>
                                <div class="act_drop" id="<?php echo $i.'x'; ?>">
                                    <div class="but_bg_outer"></div><div class="but_bg"><div  id="<?php echo $i; ?>" class="act_but_hover"><?php echo Yii::t('Batch','Actions');?></div></div>
                                    <ul>
                                        <li class="add"><?php echo CHtml::link(Yii::t('Batch','Add Leave').'<span>'.Yii::t('Batch','for add leave').'</span>', array('#'),array('class'=>'addevnt','name' => $posts_1->id,'id'=>'add_leave')) ?></li>
                                        <?php /*?><li class="add"><?php echo CHtml::link(Yii::t('Batch','Add Elective').'<span>'.Yii::t('Batch','for add leave').'</span>', array('#'),array('class'=>'addevntelect','name' => $posts_1->id,'id'=>'add_elective')) ?></li><?php */?>
                                        <li class="delete"><?php echo CHtml::link(Yii::t('Batch','Make Inactive').'<span>'.Yii::t('Batch','make students inactive').'</span>', array('/students/students/inactive', 'sid'=>$posts_1->id,'id'=>$_REQUEST['id']),array('confirm'=>'Are You Sure , Make Inactive ?')) ?></li>
                                        <!--<li class="edit"><a href="#">Edit Leave<span>for add leave</span></a></li>
                                        <li class="delete"><a href="#">Delete Leave<span>for add leave</span></a></li>
                                        <li class="add"><a href="#">Add Fees<span>for add leave</span></a></li>
                                        <li class="add"><a href="#">Add Report<span>for add leave</span></a></li>-->
                                    </ul>
                                </div>
                                <div class="clear"></div>
                                <div id="<?php echo $posts_1->id ?>"></div>
                                </div>
                                </td>
                               
                            <?php }
                            ?>
                    </table>
                <?php       
                }
                else
                {
                    echo '<br><div class="notifications nt_red" style="padding-top:10px">'.'<i>'.Yii::t('Batch','No Active Students In This Batch').'</i></div>'; 
                                    
                }
                
                }
                ?>
    
    
   

 
    </div>
    <br />
    <h3><?php echo Yii::t('Batch','Inactive Students');?></h3>
    
   
     <?php
                if(isset($_REQUEST['id']))
                {
                $posts=Students::model()->findAll("batch_id=:x and is_deleted=:y and is_active=:z", array(':x'=>$_REQUEST['id'],':y'=>'0',':z'=>'0'));
                if($posts!=NULL)
                {
                ?> <div class="table_listbx">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr >
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Sl no.');?></td>
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Student Name');?></td>
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Admission Number');?></td>
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Gender');?></td>
                    <td class="listbx_subhdng"><?php echo Yii::t('Batch','Actions');?></td>
                    </tr>
                        <?php
                        $j=$i;
                        $i=0;
                            foreach($posts as $posts_1)
                            {
                                $i++;
                                $j++;
                                echo '<tr>';
                                echo '<td>'.$i.'</td>'; 
                                echo '<td>'.CHtml::link($posts_1->first_name, array('/students/students/view', 'id'=>$posts_1->id)).'</td>';
                                echo '<td>'.$posts_1->admission_no.'</td>';?>
                                <td><?php
                                  if($posts_1->gender=='M')
                                  {
                                      echo Yii::t('Batch','Male');
                                  }
                                  elseif($posts_1->gender=='F')
                                  {
                                      echo Yii::t('Batch','Female');
                                  }?></td>
                                <td >
                                <div style="position:absolute;">
                                <div  id="<?php echo $j; ?>" class="act_but"><?php echo Yii::t('Batch','Actions');?></div>
                                <div class="act_drop" id="<?php echo $j.'x'; ?>">
                                    <div class="but_bg_outer"></div><div class="but_bg"><div  id="<?php echo $j; ?>" class="act_but_hover"><?php echo Yii::t('Batch','Actions');?></div></div>
                                    <ul>
                                        
                                        <li class="edit">
                                        
                                        <?php echo CHtml::link(Yii::t('Batch','Make Active').'<span>'.Yii::t('Batch','make students active').'</span>', array('/students/students/active', 'sid'=>$posts_1->id,'id'=>$_REQUEST['id']),array('confirm'=>'Are You Sure , Make Active ?')) ?>
                                        
                                        </li>
                                        
                                        
                                        
                                        <li class="delete">
                                        
                                        <?php echo CHtml::link(Yii::t('Batch','Delete').'<span>'.Yii::t('Batch','for deleting').'</span>', array('/students/students/deletes', 'sid'=>$posts_1->id,'id'=>$_REQUEST['id']),array('confirm'=>'Are You Sure , Delete ?')) ?>
                                        
                                         </li>
                                        
                                    </ul>
                                </div>
                                <div class="clear"></div>
                                <div id="<?php echo $posts_1->id ?>"></div>
                                </div>
                                </td>
                            <?php }
                            ?>
                    </table>
                     </div>
                <?php       
                }
                else
                {
                    echo '<br><div class="notifications nt_red" style="padding-top:10px">'.'<i>'.Yii::t('Batch','No InActive Students In This Batch').'</i></div>'; 
                                    
                }
                
                }
                ?>

   
    </div>
    </div>
    
    </div>
    </div>
     <?php      
                }
                else
                {
                     echo '<div class="emp_right" style="padding-left:20px; padding-top:50px;">';
                     echo '<div class="notifications nt_red">'.'<i>'.Yii::t('Batch','Nothing Found!!').'</i></div>'; 
                     echo '</div>';
                    
                }
                ?>
    </td>
  </tr>
</tbody></table>
</div>


<script>
    //CREATE 

    $('.addevnt').bind('click', function() {var id = $(this).attr('name');
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=students/studentLeave/returnForm",
            data:{"id":id,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#"+$(this).attr('name')).addClass("ajax-sending");
                },
                complete : function() {
                    $("#"+$(this).attr('name')).removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {window.location.reload();} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
    
    
    
    /*//CREATE 


     $('.addevntelect').bind('click', function() {var id = $(this).attr('name');
        $.ajax({
            type: "POST",
           url: "<?php //echo Yii::app()->request->baseUrl;?>/index.php?r=courses/electiveGroups/returnForm",
            data:{"batch_id":<?php //echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php //echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#"+$(this).attr('name')).addClass("ajax-sending");
                },
                complete : function() {
                    $("#"+$(this).attr('name')).removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {window.location.reload();} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind*/

    
    </script>
               



