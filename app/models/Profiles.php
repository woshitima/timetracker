<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * All the profile levels in the application. Used in conjenction with ACL lists
 * Timetracker\Models\Profiles
 * @method static Profiles findFirstById($id)
 * @package Timetracker\Models
 */
class Profiles extends Model
{
    public $id;
    public $name;

    /**
     * Define relationships to Users and Permissions
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\Users', 'profilesId', [
            'alias' => 'users',
            'foreignKey' => [
                'message' => 'Profile cannot be deleted because it\'s used on Users'
            ]
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\Permissions', 'profilesId', [
            'alias' => 'permissions',
            'foreignKey' => [
                'action' => Relation::ACTION_CASCADE
            ]
        ]);
    }
}
