<?php

namespace Timetracker\Controllers;

/**
 * Display the "About" page.
 * Timetracker\Controllers\AboutController
 * @package Timetracker\Controllers
 */
class AboutController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function indexAction()
    {
        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
        $this->view->setTemplateBefore('public');
    }
}
