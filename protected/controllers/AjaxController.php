<?php

/**
 * This is the controller that working with AJaX requests
 * 
 * @author Mihail Kornilov <fix-06 at yandex dot ru>
 */
class AjaxController extends Controller
{
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            echo $error['message'];
        }
    }
    
	/**
     * This is the action to handle external requests for adding new unit in
     * database table
     */
    public function actionAddUnit() {
        $model = new Units();

        $model->text  = Yii::app()->request->getPost('text');
        $model->count = Yii::app()->request->getPost('count');

        $unittypes = UnitTypes::model()->findByAttributes(array('type' => Yii::app()->request->getPost('type')));

        $model->type        = $unittypes->id;
        $model->date_create = date('Y/m/d h:i:s');

        if ($model->save()) {
            echo
                $model->text . '*-' .
                '<span>' . intval($model->count) . '</span>' .
                '&nbsp;&nbsp;' .
                CHtml::button('+', array('class' => 'changeCount', 'op' => 'inc', 'id' => $model->id)) .
                CHtml::button('--', array('class' => 'changeCount', 'op' => 'dec', 'id' => $model->id)) . '*-' .
                $unittypes->name_ru . '*-' .
                CHtml::button('X', array('class' => 'delRow', 'id' => $model->id));
        } else {
            echo 'Can\'t save bad data';
        }
    }

    /**
     * This is the action that delete row from Units table in the database
     * by identificator that transmits by request
     */
    public function actionDelUnit() {
        $model = new Units();
        if (!$model->deleteByPk(Yii::app()->request->getPost('id'))) {
            echo 'Don\'t delete row';
        }
    }

    /**
     * This is the action for requests from frontend for change counter of
     * units type count. It as increment counter that and decrement its
     * @throws CDbException
     */
    public function actionChangeCount() {
        $record = Units::model()->findByPk(Yii::app()->request->getPost('id'));
        if ($record == NULL) {
            throw new CDbException('Not found the record');
        }

        if (Yii::app()->request->getPost('op') == 'inc') {
            ++$record->count;
        } elseif ($record->count != 0) {
            --$record->count;
        }

        if ($record->save()) {
            echo $record->count;
        } else {
            throw new CDbException('Can\'t save changed value');
        }
    }

    /**
     * This is the action to handle external requests for showing old records
     */
    public function actionShowMoreIntervals() {
        
    }
}