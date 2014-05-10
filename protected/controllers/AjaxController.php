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
}