<?php

namespace Timetracker\Models;

use Phalcon\Mvc\Model;

/**
 * Permissions. Stores the permissions by profile
 * Timetracker\Models\Permissions
 * @package Timetracker\Models
 */
class Permissions extends Model
{
    public $id;
    public $profilesId;
    public $resource;
    public $action;

    public function initialize()
    {
        $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
            'alias' => 'profile'
        ]);
    }
}
