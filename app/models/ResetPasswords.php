<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

/**
 * ResetPasswords. Stores the reset password codes and their evolution
 * Timetracker\Models\ResetPasswords
 * @method static ResetPasswords findFirstByCode($code)
 * @package Timetracker\Models
 */
class ResetPasswords extends Model
{
    public $id;
    public $usersId;
    public $code;
    public $createdAt;
    public $modifiedAt;
    public $reset;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->reset = 'N';
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate()
    {
        // Timestamp the confirmaton
        $this->modifiedAt = time();
    }

    /**
     * Send an e-mail to users allowing him/her to reset his/her password
     */
    public function afterCreate()
    {
        $this->getDI()
            ->getMail()
            ->send([
                $this->user->email => $this->user->name
            ], "Reset your password", 'reset', [
                'resetUrl' => '/reset-password/' . $this->code . '/' . $this->user->email
            ]);
    }

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
