<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Timetracker\Models\SuccessLogins
 * @package Timetracker\Models
 */
class SuccessLogins extends Model
{
    public $id;
    public $usersId;
    public $ipAddress;
    public $userAgent;

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
