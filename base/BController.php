<?php
/**
 * @author tran.duc.thang
 * BController - Base Controller - extends the Controller class of Phalcon, with various of features included.
 * When you create a new Controller, remember to extend from BController instead of Controller to use
 * convenient features of Base Phalcon
 */
use \Phalcon\Mvc\Controller;

class BController extends Controller
{
    /**
     * @param BModel $model an instance of BModel
     * @param array $attributes the list of attributes that will be set default. If the $attributes is empty,
     * all the save attributes will be set default
     */
    public function setDefault($model, $attributes=[])
    {
        if (!$attributes) {
            $attributes = $model->getSaveAttributes();
        }
        foreach ($attributes as $att) {
            $this->tag->setDefault($att, $model->$att);
        }
    }

    /**
     * A function to use dispatcher forward in a shorter way.
     * @param string $uri . For example 'example/edit'
     * @param array $params . The parrams which will be passed to the dispatcher->forward() function
     * @return mixed
     */
    protected function forward($uri, $params=[]){
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
            [
                'controller' => $uriParts[0],
                'action' => isset($uriParts[1]) ? $uriParts[1] : 'index',
                'params' => $params,
            ]
        );
    }
} 