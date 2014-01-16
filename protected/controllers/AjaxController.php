<?php

class AjaxController extends Controller
{
	public function actionIndex()
	{
        $input = Yii::app()->request->getPost('input');
        $output = strtoupper($input);

        if (Yii::app()->request->isAjaxRequest) {
            echo $output;
            Yii::app()->end();
        } else {
            $this->render('index', ['input' => $input, 'output' => $output,]);
        }
	}

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

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}