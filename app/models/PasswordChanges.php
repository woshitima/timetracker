<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

/**
 * PasswordChanges. Register when a user changes his/her password
 * Timetracker\Models\PasswordChanges
 * @package Timetracker\Models
 */
class PasswordChanges extends Model
{
    public $id;
    public $usersId;
    public $ipAddress;
    public $userAgent;
    public $createdAt;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();
    }

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
