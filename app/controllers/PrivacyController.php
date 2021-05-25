<?php

namespace Timetracker\Controllers;

/**
 * Display the privacy page.
 * Timetracker\Controllers\PrivacyController
 * @package Timetracker\Controllers
 */
class PrivacyController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
