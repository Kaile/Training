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
            echo '<div class="unit">
                    <span class="unitText">
                        '. Yii::app()->request->getPost('text') .'
                    </span>
                    <span class="unitNumber">
                        '. Yii::app()->request->getPost('count') .'
                    </span>
                    <span class="unitType">
                        '. Yii::app()->request->getPost('type') .'
                    </span>
                 </div>';
        } catch (CDbException $e) {
            echo $e->getMessage();
        }
    }
}