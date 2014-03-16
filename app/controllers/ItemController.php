<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ItemController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for item
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Item', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery('page', 'int');
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters['order'] = 'id';

        $item = Item::find($parameters);
        if (count($item) == 0) {
            $this->flash->notice('The search did not find any item');

            return $this->forward('item');
        }

        $paginator = new Paginator(array(
            'data' => $item,
            'limit' => 10,
            'page' => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {
        $this->view->item = new Item();
    }

    /**
     * Edits a item
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $item = Item::findFirstByid($id);
            if (!$item) {
                $this->flash->error('item was not found');

                return $this->forward('item');
            }

            $this->view->id = $item->id;

            $this->setDefault($item);
        }
    }

    /**
     * Creates a new item
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('item');
        }

        $item = new Item();
        $item->load($_POST);
        $item->status = 0;
        $item->created_by = 1;

        if (!$item->save()) {
            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('item/new');
        }

        $this->flash->success('item was created successfully');

        return $this->forward('index');

    }

    /**
     * Saves a item edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward('index');
        }

        $id = $this->request->getPost('id');

        $item = Item::findFirstByid($id);
        if (!$item) {
            $this->flash->error('item does not exist ' . $id);

            return $this->forward('item');
        }

        $item->load($_POST);

        if (!$item->save()) {
            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('item/edit', [$item->id]);
        }

        $this->flash->success('item was updated successfully');

        return $this->forward('item');

    }

    /**
     * Deletes a item
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $item = Item::findFirstByid($id);
        if (!$item) {
            $this->flash->error('item was not found');

            return $this->forward('item');
        }

        if (!$item->delete()) {

            foreach ($item->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward('item/search');
        }

        $this->flash->success('item was deleted successfully');

        return $this->forward('item');
    }

}
