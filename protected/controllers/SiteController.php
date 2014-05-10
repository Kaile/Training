<?php

/**
 * Class SiteController is the base controller of this resourse
 */
class SiteController extends Controller 
{

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() 
	{
		$model = new Units('AddUnit');

        if (isset($_POST['Units'])) {
			$model->attributes = Yii::app()->request->getPost('Units');
			
			$model->save();
		}
		
		$allUnitTypes = UnitTypes::model()->findAll();
		$unitTypes    = array();
		
		foreach ($allUnitTypes as $val) {
			$unitTypes[$val->id] = $val->name_ru;
		}
		
		$this->render(
			'index', 
			array(
					'model' => $model,
					'unitList' => $model->findAll(),
					'unitTypes' => $unitTypes
			)
			);
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
//        define('DAY_BEGIN', 2);
//
//        $chDate = (!isset($_POST['chDate'])) ? 'now' : $_POST['chDate'];        
//		
//		$dateint = new DateJump(DAY_BEGIN, 6, $chDate);
//
//        $criteria = new CDbCriteria();
//        $criteria->join = 'LEFT JOIN UnitTypes s ON t.type = s.id';
//        $criteria->select = 't.id, t.text, t.count, s.name_ru as type';
//        $criteria->condition = 'date_create >= "' . $dateint->startDate->format(DateJump::DATE_FORMAT) . ' 00:00:00"';
//        $criteria->condition .= 'AND date_create <= "' . $dateint->endDate->format(DateJump::DATE_FORMAT) . ' 00:00:00"';
//
//        $statistic = Units::model()->findAll($criteria);
//
//        $unittypes = UnitTypes::model()->findAll();
//
//        $this->render('index', array(
//								'statistic' => $statistic, 
//								'unittypes' => $unittypes,
//								'dateInterval' => $dateint
//								)
//					);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() 
	{
        if ($error = Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
	
	public function actionAddUnitType() 
	{
		$unitTypes = new UnitTypes('AddUnitType');
		
		if (isset($_POST['UnitTypes'])) {
			$unitTypes->attributes = Yii::app()->request->getPost('UnitTypes');

			$unitTypes->save();
		}
		
		$this->render('AddUnitType', array(
				'unitTypes' => $unitTypes,
				'list'      => $unitTypes->findAll()
			));
	}
}
