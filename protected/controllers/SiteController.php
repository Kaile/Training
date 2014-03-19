<?php

/**
 * Class SiteController
 */
class SiteController extends Controller {
    
    /**
     * This finction need to generate string that contained start date that 
     * creating that nearest day $day of week from current date, and end 
     * date that formed that offset by $offset days from start date.
     * @param integer $day
     * @param integer $offset
     * @return string date diff from start date to date that is offseting 
     *          from start date
     */
    private function getWeekDateDiff($day = 0, $offset = 7) {
        if ($day < 0 || $day > 6) {
            $day = 0;
        }
        if ($offset < 0) {
            $offset = 0;
        }
        $startDate           = new DateTime();
        $currDateDescription = getdate();
        
        $currDayOffset = $day - $currDateDescription['wday'];
        
        ($currDayOffset <= 0) ? $currDayOffset = abs($currDayOffset) : $currDayOffset = 7 - $currDayOffset;
        
        $dateInterval = new DateInterval('P' . $currDayOffset . 'D');
       
        $startDate->sub($dateInterval);
        
        $dateInterval->d = $offset;
        
        $endDate = clone $startDate;
        $endDate->add($dateInterval);
        
        return date_format($startDate, 'Y/m/d') . ' - ' . date_format($endDate, 'Y/m/d');
    }
    
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $criteria = new CDbCriteria();
        
        $criteria->join = 'LEFT JOIN UnitTypes s ON t.type = s.id';
        $criteria->select = 't.id, t.text, t.count, s.name_ru as type';
        $criteria->condition = 'date_create >= "' . split(' - ', $this->getWeekDateDiff(2))[0] . ' 00:00:00"';
        $criteria->condition .= 'AND date_create <= "' . split(' - ', $this->getWeekDateDiff(2))[1] . ' 00:00:00"';
        
        $statistic = Units::model()->findAll($criteria);
        
        $unittypes = UnitTypes::model()->findAll();
        
        $date = $this->getWeekDateDiff(3);

        $this->render('index', array('statistic' => $statistic, 'unittypes' => $unittypes, 'date' => $date));
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
        $model = new Units();

        $model->text = Yii::app()->request->getPost('text');
        $model->count = Yii::app()->request->getPost('count');
        
        $unittypes = UnitTypes::model()->findByAttributes(array('type' => Yii::app()->request->getPost('type')));
        
        $model->type = $unittypes->id;
        
        $model->date_create = date('Y/m/d h:i:s');                                  //new CDbExpression('NOW()');

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

    public function actionDelUnit() {
        $model = new Units();
        if (!$model->deleteByPk(Yii::app()->request->getPost('id'))) {
            echo 'Don\'t delete row';
        }
    }
    
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
