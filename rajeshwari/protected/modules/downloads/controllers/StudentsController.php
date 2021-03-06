<?php

class StudentsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */	 
	
	public function actionIndex()
	{
		$criteria	=	new CDbCriteria;
		$criteria->condition	=	'';		
		$roles	=	Rights::getAssignedRoles(Yii::app()->user->id); // check for single role
		$user_roles	=	array();
		foreach($roles as $role){
			$user_roles[]	=	'"'.$role->name.'"';
		}
		$student = Students::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
		$batch = Batches::model()->findByAttributes(array('id'=>$student->batch_id));
		$criteria->condition			.=	'`file`<>:null AND (`placeholder`=:null OR `placeholder` IN ('.implode(',',$user_roles).')) AND ((`course` IS NULL) OR (`course`=:course) OR (`course`=0)) AND ((`batch` IS NULL) OR (`batch`=:batch) OR (`batch`=0))';
		$criteria->params	=	array(':null'=>'',':course'=>$batch->course_id,':batch'=>$batch->id);
		$criteria->order	=	'`created_at` DESC';
		//print_r($criteria); exit;
		$files		=	FileUploads::model()->findAll($criteria);
		if(isset($_POST['Downfiles'])){
			$selected_files	=	$_POST['Downfiles'];
			$slfiles	=	array();
			foreach($selected_files as $s_file){
				$model	=	FileUploads::model()->findByPk($s_file);
				if($model!=NULL){					
					$slfiles[]	=	'uploads/shared/'.$model->id.'/'.$model->file;
				}
			}			
			$zip			=	Yii::app()->zip;
			$fName			=	$this->generateRandomString(rand(10,20)).'.zip';
			$zipFile		=	'compressed/'.$fName;
			if($zip->makeZip($slfiles,$zipFile)){
				$fcon	=	file_get_contents($zipFile);
				header('Content-type:text/plain');
				header('Content-disposition:attachment; filename='.$fName);
				header('Pragma:no-cache');
				echo $fcon;
				unlink($zipFile);
			}
			else{
				Yii::app()->user->setFlash('success','Can\'t download');
			}
			
		}
		$this->render('/fileUploads/index',array('files'=>$files));
	}
	
	public function loadModel($id)
	{
		$model=FileUploads::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadAuthorized($attributes)
	{
		$model=FileUploads::model()->findByAttributes($attributes);
		if($model===null){
			if(Yii::app()->request->isAjaxRequest){
				header("HTTP/1.0 404 Not Found");
				echo 'You are not authorized to perform this action.';
				exit;
			}
			else
				throw new CHttpException(404,'You are not authorized to perform this action.');
		}
		return $model;
	}

	
	private function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}