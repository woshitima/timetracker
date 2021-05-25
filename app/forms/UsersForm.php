<?php

namespace Timetracker\Forms;

use Phalcon\Forms\Form;
use Timetracker\Models\Profiles;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email as EmailText;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

/**
 * Timetracker\Forms\UsersForm
 * @package Timetracker\Forms
 */
class UsersForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // In edition the id is hidden
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id');
        }
        $this->add($id);

        $name = new Text('name', [
            // 'placeholder' => 'Name'
        ]);
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);
        $this->add($name);

        $email = new EmailText('email', [
        ]);
        $email->setLabel('Email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password');

        $password->setLabel('Password');

        $password->addValidators([
            new PresenceOf([
                'message' => 'The password is required'
            ]),
            new StringLength([
                'min' => 6,
                'messageMinimum' => 'Password is too short. Minimum 6 characters'
            ])
        ]);

        $this->add($password);

        $profiles = Profiles::find([
            'active = :active:',
            'bind' => [
                'active' => 'Y'
            ]
        ]);

        $profilesId = new Select('profilesId', $profiles, [
            'using' => [
                'id',
                'name'
            ],
            'useEmpty' => true,
            'emptyText' => '...',
            'emptyValue' => '',
        ]);
        $profilesId->setLabel('Profile');
        $this->add($profilesId);

        $active = new Select('active', [
            'Y' => 'Yes',
            'N' => 'No'
        ]);
        $active->setLabel('Active');
        $this->add($active);
    }
}