<?php

/**
 * Class SiteController is the base controller of this resourse
 */
class SiteController extends Controller {

    /**
     * This finction need to generate string that contained start date that 
     * creating that nearest day $day of week from current date, and end 
     * date that formed that offset by $offset days from start date.
     * @param integer $day - number of week day (0 - 6) 0 - sunday, 1 - monday ...
     *          if day is larger that 6 or less that 0 it will stay at 0
     * @param integer $offset - shift for find date that on $offset days larger 
     *          that date how was found for $day. If $offset less that 0, then
     *          it will be stay at 7
     * @param string $defDate - by default is current date. Set date that using
     *          how base date with respect to witch calculating start date. 
     *          This parameter must be a valid parsing date format
     * @param string $separator - string that separate date interval
     * @return string date diff from start date to date that is offseting 
     *          from start date
     */
    public function getWeekDateInterval($day = 0, $offset = 7, $defDate = 'now', $separator = ' - ') {
        if ($day < 0 || $day > 6) {
            $day = 0;
        }
        if ($offset < 0) {
            $offset = 7;
        }
        $startDate = new DateTime($defDate);
        $currDateDescription = getdate();

        $currDayOffset = $day - $currDateDescription['wday'];

        ($currDayOffset <= 0) ? $currDayOffset = abs($currDayOffset) : $currDayOffset = 7 - $currDayOffset;

        $dateInterval = new DateInterval('P' . $currDayOffset . 'D');

        $startDate->sub($dateInterval);

        $dateInterval->d = $offset;

        $endDate = clone $startDate;
        $endDate->add($dateInterval);

        return $startDate->format('Y/m/d') . $separator . $endDate->format('Y/m/d');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        define('DAY_BEGIN', 2);

        $arrDate = split(' - ', $this->getWeekDateInterval(DAY_BEGIN));

        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN UnitTypes s ON t.type = s.id';
        $criteria->select = 't.id, t.text, t.count, s.name_ru as type';
        $criteria->condition = 'date_create >= "' . $arrDate[0] . ' 00:00:00"';
        $criteria->condition .= 'AND date_create <= "' . $arrDate[1] . ' 00:00:00"';

        $statistic = Units::model()->findAll($criteria);

        $unittypes = UnitTypes::model()->findAll();

        $this->render('index', array('statistic' => $statistic, 'unittypes' => $unittypes));
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

    /**
     * This is the action to handle external requests for adding new unit in
     * database table
     */
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
