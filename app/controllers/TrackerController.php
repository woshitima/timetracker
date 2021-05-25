<?php

namespace Timetracker\Controllers;

use Timetracker\Forms\WorkedhoursForm;
use Timetracker\Models\Holidays;
use Timetracker\Models\Latecomers;
use Timetracker\Models\Late;
use Timetracker\Models\TimeData;
use Timetracker\Models\Users;
use DateTime;
use DateTimeZone;


class TrackerController extends ControllerBase
{
    public function indexAction()
    {
        $userId = '';
        if ($this->session->has('id')) {
            $userId = $this->session->get('id');
        }
        $dates = [];
        for ($i = 1; $i <= date('t'); $i++) {
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }
        $users = Users::find();

        foreach ($dates as $d) {
            $currentMonth = intval(date('m', strtotime($d))); // current month
        }

        $holidaysNum = Holidays::find([ // number of holidays
          'conditions' => 'month = :m:',
            'bind' => [
                'm' => $currentMonth
            ]
        ]);

        $workingHours = Holidays::calc($holidaysNum); // number of working hours x
        $time = Late::findFirst();
        $totalTime = TimeData::find();
        $last = $totalTime->getLast();

//        print_die(TimeData::getTotalTime($totalTime));
        $this->view->setVars(
            [
                'dates' => $dates,
                'userId' => $userId,
                'users' => $users,
                'numberOfWorkingHours' => $workingHours,
                'setTime' => $time->time,
                'totalTime' => $last->total_time
            ]
        );
        $this->assets->addJs('js/main.js');
    }

    public function testAction()
    {
        $user_id = '';
        if ($this->session->has('id')) {
            // Получение значения user id
            $user_id = $this->session->get('id');
        }
        $state = "";
        if (isset($_POST['state'])) {
            $state = $_POST['state'];
        }
        $date = new DateTime();
        $timeNow = $date->format('H:i');
        $today = $date->format("Y-m-d ");
        if ($state == "start") {
            $time = new TimeData();

            $time->start_time = $timeNow;
            $late = Late::findFirst();
            $isExist = Latecomers::findFirst([
                'conditions' => 'user_id = :user_id: AND date = :today:',
                'bind' => [
                    'user_id' => $user_id,
                    'today' => $today,
                ]
            ]);

//            print_die($isExist->date)

//            $timeArray = ((array)$isExist);
//            print_die(gettype($timeArray->date));
//            print_die($timeArray);
//            print_die(count($isExist->date));
//            print_die(!count($timeArray->date));
            if (count($isExist->date) < 1) {
                if (strtotime($time->start_time) > strtotime($late->time)) {
                    $userLate = new Latecomers();
                    $userLate->user_id = $user_id;
                    $userLate->time = $timeNow;
                    $userLate->date = $today;
                    if ($userLate->save() === false) {
                        $messages = $userLate->getMessages();
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    } else {
                        echo "Success!";
                    }
                }
            }

            $time->state = $state;
            $time->user_id = $user_id;
            $time->date = $today;
            $time->save();
            //
            $this->session->set('last_time_id', $time->id);
        } elseif ($state == "stop") {
            $last_id = $this->session->get('last_time_id');
            $time = TimeData::findFirst([
                'conditions' => 'id = :id:',
                'bind' => [
                    'id' => $last_id
                ]
            ]);
            $time->end_time = $timeNow;
            $time->state = 'stop';
            $time->update();

            $time = TimeData::find();
            $last = $time->getLast();
            $start = $last->start_time;
            $stop = $last->end_time;
            $work_time = (strtotime($start) - strtotime($stop)) / 60;
            $time = TimeData::find([
                'conditions' => 'user_id = :id:',
                'bind' => [
                    'id' => $user_id
                ]
            ]);
            $sum = 0;
            foreach ($time as $item) {
                $sum = $sum + intval($item->work_time);
            }
            $hours = TimeData::changeFormatTime($sum);
            $last->work_time = abs($work_time);
            $last->total_time = $hours;
            $last->update();
        }
        return json_encode($time);
    }
}


