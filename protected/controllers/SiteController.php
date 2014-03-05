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
        $model = new Units();

        $statistic = $model->findAll();
        
		$this->render('index', array('statistic' => $statistic));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error = Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
            }
			else {
				$this->render('error', $error);
            }
		}
	}

    public function actionAddUnit() {
        $model = new Units();
        
        foreach ($_POST as $key => $val) {
            $model->$key = $val;
        }
        
        try {
            $model->save();
            echo Yii::app()->request->getPost('text') . '-' .
                 Yii::app()->request->getPost('count') . '-' .
                 Yii::app()->request->getPost('type');
        } catch (CDbException $e) {
            echo 'Error occur: ' . $e->getMessage();
        }
    }
}