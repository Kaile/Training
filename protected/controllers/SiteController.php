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
        $currDateDescription = getdate($startDate->getTimestamp());

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

        $chDate = (!isset($_POST['chDate'])) ? 'now' : $_POST['chDate'];        
        $arrDate = explode(' - ', $this->getWeekDateInterval(DAY_BEGIN, 6, $chDate));

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
            $this->render('error', $error);
        }
    }
}
