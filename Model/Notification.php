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

    function msg($user_id, $message, $type = null, $target = null) {
        $data = array();
        $data['Notification']['user_id'] = $user_id;
        $data['Notification']['message'] = $message;
        $data['Notification']['type'] = $type;
        $data['Notification']['target'] = $target;
        if ($this->send($data)) {
            return true;
        } else {
            return false;
        }
    }

}
