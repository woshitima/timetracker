<?php

namespace Timetracker\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;

class LatecomersForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $date = new Date('date');
        $date->setLabel('date');
        $date->addValidators([
            new PresenceOf([
                'message' => 'Date is required'
            ])
        ]);
        $this->add($date);
    }
}