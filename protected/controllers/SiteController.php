<?php

/**
 * Class SiteController
 */
class SiteController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'


		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionAddUnit() {
        $units = new Units();

        $units->text = Yii::app()->request->getPost('Text');
        $units->count = Yii::app()->request->getPost('Count');
        $units->type = 'hours';
        $units->date = '2014/02/24';
        $units->save();

        echo('true');

    }
}