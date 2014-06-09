<?php

class CrudController extends Controller
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
    */
	
   public function actionIndex() {
	   echo 'brrrrr';
	   Yii::app()->end();
   }


   public function actions()
	{
		// return external action classes, e.g.:
		return array(
				'delunit' => 'application.controllers.DeleteAction'
//				'delunit' => array (
//						'class' => 'application.controllers.DeleteAction',
//						'model' => 'Units'
//				)
		);
	}
}