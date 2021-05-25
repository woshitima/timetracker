<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

class Holidays extends Model
{
    public $id;
    public $name;
    public $day;
    public $month;
    public $active;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("time");
        $this->setSource("holidays");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'holidays';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Holidays[]|Holidays|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Holidays|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function calc($holidaysNum){
        $startDate = date('Y-m-01');
//        $holidays = Holidays::find();
        $endDate = date('Y-m-t');

        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);
        $days = ($endDate - $startDate) / 86400 + 1;
        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week)
                $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week)
                $no_remaining_days--;
        } else {
            if ($the_first_day_of_week == 7) {
                $no_remaining_days--;
                if ($the_last_day_of_week == 6) {
                    $no_remaining_days--;
                }
            } else {
                $no_remaining_days -= 2;
            }
        }
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $workingDays += $no_remaining_days;
        }


        $TotalDays = $workingDays - count($holidaysNum->toArray());
//         echo $TotalDays;
        $workingH = $TotalDays * 8;


        return $workingH;
    }
}
