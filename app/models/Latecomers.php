<?php
namespace Timetracker\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

class Latecomers extends Model
{
    public $id;
    public $user_id;
    public $time;
    public $date;

    public function initialize()
    {
        $this->setSchema("time");
        $this->setSource("latecomers");
        $this->belongsTo('user_id', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'users',
            'reusable' => true
        ]);
    }

    public function getSource()
    {
        return 'latecomers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Latecomers[]|Latecomers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Latecomers|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
}