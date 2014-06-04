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
			$model->date_create = date('Y/m/d h:i:s');
			$model->save();
		}
		
		$allUnitTypes = UnitTypes::model()->findAll();
		$unitTypes    = array();
		
		foreach ($allUnitTypes as $val) {
			$unitTypes[$val->id] = $val->name_ru;
		}

		$chDate = (!isset($_POST['chDate'])) ? 'now' : $_POST['chDate'];        
		
		$dateint = new DateJump(2, 6, $chDate);
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'date_create >= "' . $dateint->startDate->format(DateJump::DATE_FORMAT) . ' 00:00:00"';
		$criteria->condition .= 'AND date_create <= "' . $dateint->endDate->format(DateJump::DATE_FORMAT) . ' 00:00:00"';

		$this->render(
			'index', 
			array(
					'model' => $model,
					'unitList' => $model->findAll($criteria),
					'unitTypes' => $unitTypes,
					'dateInterval' => $dateint
			)
			);
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
