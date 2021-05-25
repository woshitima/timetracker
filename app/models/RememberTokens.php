<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

/**
 * RememberTokens. Stores the remember me tokens
 * Timetracker\Models\RememberTokens
 * @package Timetracker\Models
 */
class RememberTokens extends Model
{
    public $id;
    public $usersId;
    public $token;
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
