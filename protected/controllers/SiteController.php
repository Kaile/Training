<?php

/**
 * Class SiteController
 */
class SiteController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Units::model();

        $criteria = new CDbCriteria();
        
        $criteria->join = 'LEFT JOIN UnitTypes s ON t.type = s.id';
        $criteria->select = 't.text, t.count, s.name_ru as type';
        
        $statistic = $model->findAll($criteria);

        $this->render('index', array('statistic' => $statistic));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionAddUnit() {
        $model = Units::model();

        $model->text = Yii::app()->request->getPost('text');
        $model->count = Yii::app()->request->getPost('count');
        
        $unittypes = new UnitTypes();
        
//        $unittypes->findByAttributes(array('type' => Yii::app()->request->getPost('type')));
        
        $model->type = 1;
        
//        $date = new DateTime(null);
//        $date->format(DateTime::ATOM);

        if ($model->save()) {
            echo $model->text . '*-' .
            intval($model->count) . '*-' .
            $model->type . '*-' .
            CHtml::button('X', array('class' => 'delRow', 'id' => $model->id));
        } else {
            echo 'Can\'t save bad data';
        }
    }

    public function actionDelUnit() {
        $model = Units::model();

        $model->deleteByPk(Yii::app()->request->getPost('id'));
    }

}
