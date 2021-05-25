<?php

namespace Timetracker\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * Timetracker\Forms\ProfilesForm
 * @package Timetracker\Forms
 */
class ProfilesForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id');
        }
        $this->add($id);

        $name = new Text('name');
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);
        $this->add($name);

        $active = new Select('active', [
            'Y' => 'Yes',
            'N' => 'No'
        ]);
        $active->setLabel('Active');
        $this->add($active);
    }
}