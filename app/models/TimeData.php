<?php

namespace Timetracker\Models;

class TimeData extends \Phalcon\Mvc\Model
{
    public $id;
    public $start_time;
    public $end_time;
    public $state;
    public $user_id;
    public $work_time;
    public $date;
    public $total_time;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("time");
        $this->setSource("time_data");
        $this->belongsTo('user_id', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user',
            'reusable' => true
        ]);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'time_data';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TimeData[]|TimeData|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TimeData|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function changeFormatTime($sum)
    {
        // Total
        if ($sum <= 0) {
            return '00:00';
        } else {
            return sprintf("%02d", floor($sum / 60)) . ':' . sprintf("%02d", str_pad(($sum % 60), 2, "0", STR_PAD_LEFT)) . "";
        }
    }
    public function getUserId()
    {
        return $this->user_id;
    }

    public static function getTotalTime($totalTime)
    {
        $total = 0;
        foreach ($totalTime as $item) {
            $total = $total + intval($item->work_time);
        }
        return $total;
    }
}
