<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends BController
{
    public function initialize()
    {
        $this->tag->setTitle('Framgia Hyakkaten');
    }
}
