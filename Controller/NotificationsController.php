<?php

App::uses('NotificationsAppController', 'Notifications.Controller');

class NotificationsController extends NotificationsAppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Notification->recursive = 0;
        $this->paginate = array(
            'order' => array('created' => 'desc')
        );
        $this->set('data', $this->paginate('Notification', array('user_id' => AuthComponent::user('id'))));
    }

    /**
     * read method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function read($id = null) {
        $this->Notification->id = $id;
        if (!$this->Notification->exists()) {
            throw new NotFoundException(__('Invalid notification'));
        }

        $this->Notification->id = $id;
        $this->Notification->saveField('is_read', 1);

        $this->Notification->recursive = -1;
        $item = $this->Notification->read(null, $id);

        if (!isset($item['Notification']['target'])) {
            $target = $this->redirect(array('action' => 'index'));
        } else {
            $target = $this->redirect($item['Notification']['target']);
        }
        $this->redirect($target);
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Notification->id = $id;
        if (!$this->Notification->exists()) {
            throw new NotFoundException(__('Invalid notification'));
        }
        if ($this->Notification->delete()) {
            $this->Session->setFlash(__('Notification deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Notification was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Delete all the notifications for the current user
     * 
     * @return void 
     */
    public function deleteall() {
        if ($this->Notification->deleteAll(array('user_id' => AuthComponent::user('id')))) {
            $this->Session->setFlash(__('Notification deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Notification was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Marks all the notifications read for the current user
     * 
     * @return void 
     */
    public function markallread() {
        if ($this->Notification->markAllRead(AuthComponent::user('id'))) {
            $this->Session->setFlash(__('Marked all read'));
        } else {
            $this->Session->setFlash(__('Failed to mark all read'));
        }
        $this->redirect(array('action' => 'index'));
    }

    /**
     * API functions that gets the number of notifications
     * 
     * @param type $user_id 
     */
    public function getcount($user_id = null) {
        $this->layout = 'ajax';
        $result = null;

        $result = $this->Notification->find('count', array('conditions' => array('is_read' => 0, 'user_id' => $user_id)));

        if ($user_id && $user_id == AuthComponent::user('id')) {
            $this->set('result', $result);
        } else {
            $this->set('result', null);
        }
    }

    /**
     * API functions that gets the last 10 unread notifications
     * 
     * @param type $user_id 
     */
    public function getlist($user_id = null, $limit = 10) {
        $this->layout = 'ajax';
        $result = null;

        $options = array(
            'conditions' => array('is_read' => 0, 'user_id' => $user_id),
            'order' => array('Notification.created' => 'desc'),
            'limit' => $limit,
        );

        $result = $this->Notification->find('all', $options);

        if ($user_id && $user_id == AuthComponent::user('id')) {
            $this->set('result', $result);
        } else {
            $this->set('result', null);
        }
    }

}
