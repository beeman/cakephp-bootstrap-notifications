<?php

App::uses('NotificationsAppModel', 'Notifications.Model');

class Notification extends NotificationsAppModel {

    public $virtualFields = array(
        'name' => 'message'
    );
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    function send($data) {
        $this->create();
        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }
    }

    function msg($userId, $message, $type = null, $target = null, $senderId = null) {
        $data = array();
        $data['Notification']['user_id'] = $userId;
        $data['Notification']['sender_id'] = $senderId;
        $data['Notification']['message'] = $message;
        $data['Notification']['type'] = $type;
        $data['Notification']['target'] = $target;
        if ($this->send($data)) {
            return true;
        } else {
            return false;
        }
    }

    function markAllRead($userId) {
        $fields = array(
            $this->alias . '.is_read' => 1
        );
        $conditions = array(
            $this->alias . '.is_read' => 0,
            $this->alias . '.user_id' => $userId
        );
        if ($this->updateAll($fields, $conditions)) {
            return true;
        } else {
            return false;
        }
    }

    function getCount($userId) {
        $options = array(
            'conditions' => array('is_read' => 0),
            'conditions' => array('user_id' => $userId),
        );
        return $this->find('count', $options);
    }

    function getList($userId, $limit = 10, $only_new = true) {
        if ($only_new) {
            $options = array(
                'conditions' => array('is_read' => 0),
                'conditions' => array('user_id' => $userId),
                'limit' => $limit,
                'order' => array(
                    'is_read' => 'asc',
                    'created' => 'desc'
                ),
            );
        } else {
            $options = array(
                'conditions' => array('user_id' => $userId),
                'limit' => $limit,
                'order' => array(
                    'is_read' => 'asc',
                    'created' => 'desc'
                ),
            );
        }


        return $this->find('all', $options);
    }

}
