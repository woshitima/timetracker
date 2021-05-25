<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * All the users registered in the application
 * Timetracker\Models\Users
 * @method static Users findFirstById($id)
 * @method static Users findFirstByEmail($email)
 * @package Timetracker\Models
 */
class Users extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $mustChangePassword;
    public $profilesId;
    public $banned;
    public $suspended;
    public $active;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {

        $this->active = 'Y';
        // The account is not suspended by default
        $this->suspended = 'N';
        $this->mustChangePassword = 'N';
        // The account is not banned by default
        $this->banned = 'N';
    }

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "The email is already registered"
        ]));

        return $this->validate($validator);
    }

    public function initialize()
    {
        $this->setSource("users");
        $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
            'alias' => 'profile',
            'reusable' => true
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\TimeData', 'user_id', [
            'alias' => 'times',
            'reusable' => true
        ]);
    }

    public function getTimes($params = null)
    {
        return $this->getRelated('Time');
    }
}