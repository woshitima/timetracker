<?php
namespace Timetracker\Forms;

use Phalcon\Forms\Element\AbstractElement;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;

class WorkedhoursForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // In edition the id is hidden
        if (isset($options['edit'])) {
            $this->add(new Hidden('id'));
        }

        /**
         * Year text field
         */
        $year = new Text('year');
        $year->setLabel('Year');
        $year->addValidators([
            new PresenceOf(['message' => 'Year is required']),
        ]);

        $this->add($year);

        /**
         * Month text field
         */
        $month = new Text('month');
        $month->setLabel('Month');
        $month->addValidators([
            new PresenceOf(['message' => 'Month is required']),
        ]);

        $this->add($month);

        /**
         * Day text field
         */
        $day = new Text('day');
        $day->setLabel('Day');
        $day->addValidators([
            new PresenceOf(['message' => 'Month is required']),
        ]);

        $this->add($day);

        /**
         * Start time text field
         */
        $startTime = new Text('start_time');
        $startTime->setLabel('Start time');
        $startTime->addValidators([
            new PresenceOf(['message' => 'Start time is required']),
        ]);

        $this->add($startTime);

        /**
         * End time text field
         */
        $endTime = new Text('end_time');
        $endTime->setLabel('End time');
        $endTime->addValidators([
            new PresenceOf(['message' => 'End time is required']),
        ]);
        $this->add($endTime);

        /**
         * Total text field
         */
        $total = new Text('total');
        $total->setLabel('Total');
        $total->addValidators([
            new PresenceOf(['message' => 'Total is required']),
        ]);
        $this->add($total);
    }
}