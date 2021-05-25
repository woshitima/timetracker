<?php

namespace Timetracker\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Timetracker\Models\Late;

class LateController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->late = Late::find();
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('private');
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->setTemplateBefore('private');
    }

    /**
     * Edits late data
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('private');
        if (!$this->request->isPost()) {
            $late = Late::findFirstByid($id);
            if (!$late) {
                $this->flash->error("late was not found");

                $this->dispatcher->forward([
                    'controller' => "late",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $late->id;

            $this->tag->setDefault("id", $late->id);
            $this->tag->setDefault("time", $late->time);
        }
    }

    public function latecomersAction()
    {
    }

    /**
     * Creates a new late
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);
            return;
        }

        $late = new Late();
        print_die($late);
        $late->time = $this->request->getPost("time");
        $late->total = $this->request->getPost("total");

        if (!$late->save()) {
            foreach ($late->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("late was created successfully");

        $this->dispatcher->forward([
            'controller' => "late",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a late edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $late = Late::findFirstByid($id);

        if (!$late) {
            $this->flash->error("late does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);

            return;
        }

        $late->time = $this->request->getPost("time");
        $late->total = $this->request->getPost("total");


        if (!$late->save()) {
            foreach ($late->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'edit',
                'params' => [$late->id]
            ]);

            return;
        }

        $this->flash->success("Start time was updated successfully!");

        $this->dispatcher->forward([
            'controller' => "late",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a late
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $late = Late::findFirstByid($id);
        if (!$late) {
            $this->flash->error("late was not found");

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'index'
            ]);

            return;
        }

        if (!$late->delete()) {
            foreach ($late->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "late",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("late was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "late",
            'action' => "index"
        ]);
    }
}