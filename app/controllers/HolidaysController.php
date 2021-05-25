<?php

namespace Timetracker\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Timetracker\Models\Holidays;

class HolidaysController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('private');
        $this->view->holidays = Holidays::find();
    }

    /**
     * Searches for holidays
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Holidays', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $holiday = Holidays::find($parameters);
        if (count($holiday) == 0) {
            $this->flash->notice("The search did not find any holidays");

            $this->dispatcher->forward([
                "controller" => "holidays",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $holiday,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->setTemplateBefore('public');
    }

    /**
     * Edits a holidays
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');

        if (!$this->request->isPost())
        {
            $holiday = Holidays::findFirstByid($id);
            if (!$holiday) {
                $this->flash->error("Holiday was not found");

                $this->dispatcher->forward([
                    'controller' => "holidays",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $holiday->id;

            $this->tag->setDefault("id", $holiday->id);
            $this->tag->setDefault("name", $holiday->name);
            $this->tag->setDefault("day", $holiday->day);
            $this->tag->setDefault("month", $holiday->month);
            $this->tag->setDefault("active", $holiday->active);
        }
    }

    /**
     * Creates new holidays
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'create'
            ]);

            return;
        }

        $holiday = new Holidays();
        $holiday->name = $this->request->getPost("name");
        $holiday->day = $this->request->getPost("day");
        $holiday->month = $this->request->getPost("month");
        $holiday->active = $this->request->getPost("active");

        if (!$holiday->save()) {
            foreach ($holiday->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Holiday was created successfully");

        $this->dispatcher->forward([
            'controller' => "holidays",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a holidays edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'index'
            ]);
            return;
        }

        $id = $this->request->getPost("id");
        $holiday = Holidays::findFirstByid($id);

        if (!$holiday) {
            $this->flash->error("holidays does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'index'
            ]);
            return;
        }

        $holiday->name = $this->request->getPost("name");
        $holiday->dateHoliday = $this->request->getPost("day");
        $holiday->dateHoliday = $this->request->getPost("month");
        $holiday->active = $this->request->getPost("active");

        if (!$holiday->save())
        {
            foreach ($holiday->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'edit',
                'params' => [$holiday->id]
            ]);

            return;
        }

        $this->flash->success("The holiday was updated successfully");

        $this->dispatcher->forward([
            'controller' => "holidays",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a holidays
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $holiday = Holidays::findFirstByid($id);
        if (!$holiday) {
            $this->flash->error("The holiday was not found");

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'index'
            ]);

            return;
        }

        if (!$holiday->delete())
        {
            foreach ($holiday->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "holidays",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("The holiday was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "holidays",
            'action' => "index"
        ]);
    }
}