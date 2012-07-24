<?php

App::uses('NotificationsAppController', 'Notifications.Controller');

class NotificationsController extends NotificationsAppController {

    /**
     * read method. Marks the notification read and redirects to the target (if any)
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
            $target = $this->redirect($this->referer('/'));
        } else {
            $target = $this->redirect($item['Notification']['target']);
        }
        $this->redirect($target);
    }

    /**
     * delete method. Deletes a single notification
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Notification->id = $id;
        if ($this->request->is('ajax')) {
            $this->layout = false;
            $this->autoRender = false;
            if (!$this->Notification->exists()) {
                return 0;
            }
            if (!$this->Notification->delete()) {
                return 0;
            } else {
                return 1;
            }
        } else {
            if (!$this->Notification->exists()) {
                throw new NotFoundException(__('Invalid notification'));
            }
            if (!$this->Notification->delete()) {
                $this->Session->setFlash(__('Notification was not deleted'));
            }
            $this->redirect($this->referer('/'));
        }
    }

    /**
     * Delete all the notifications for the current user
     * 
     * @return void 
     */
    public function deleteall() {
        if (!$this->Notification->deleteAll(array('user_id' => AuthComponent::user('id')))) {
            $this->Session->setFlash(__('Notifications are not deleted'));
        }
        $this->redirect($this->referer('/'));
    }

    /**
     * Marks all the notifications read for the current user
     * 
     * @return void 
     */
    public function markallread() {
        if (!$this->Notification->markAllRead(AuthComponent::user('id'))) {
            $this->Session->setFlash(__('Failed to mark all read'));
        }
        $this->redirect($this->referer('/'));
    }

    /**
     * API functions that gets the number of notifications
     * 
     * @param type $userId 
     */
    public function getcount($userId = null) {
        $this->layout = 'ajax';
        if ($userId && $userId == AuthComponent::user('id')) {
            $this->set('result', $this->Notification->getCount($userId));
        } else {
            $this->set('result', null);
        }
    }

    /**
     * API functions that gets the last 10 unread notifications
     * 
     * @param type $user_id 
     */
    public function getlist($userId = null, $limit = 10) {
        $this->layout = 'ajax';
        if ($userId && $userId == AuthComponent::user('id')) {
            $this->set('result', $this->Notification->getList($userId, $limit));
        } else {
            $this->set('result', null);
        }
    }

}
