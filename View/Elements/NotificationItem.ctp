<?php
$data['id'] = $notification['Notification']['id'];
$data['time'] = $this->Time->timeAgoInWords($notification['Notification']['created']->sec);

if (isset($notification['Sender']['User']['username'])) {
    $data['sender'] = $notification['Sender']['User']['username'];
}

$data['message'] = "";
if (isset($notification['Sender']['User']['username'])) {
    $data['message'] = "<b>{$notification['Sender']['User']['username']}</b> ";
}

if (isset($notification['Notification']['message'])) {
    $data['message'] = "{$data['message']}{$notification['Notification']['message']}";
}

if (isset($notification['Notification']['is_read']) && $notification['Notification']['is_read']) {
    $data['is_read'] = '';
} else {
    $data['is_read'] = 'unread';
}

if (isset($notification['Sender']['User']['email'])) {
    $email = md5(strtolower(trim($notification['Sender']['User']['email'])));
} else {
    $email = md5(strtolower(trim(AuthComponent::user('email'))));
}
$data['avatar'] = "http://www.gravatar.com/avatar/$email?s=50&d=mm";
?>

<li id="<?php echo $data['id']; ?>" class="notification-item <?php echo $data['is_read']; ?>" style="position: relative;">
    <a id="<?php echo $data['id']; ?>" href="<?php echo $this->Html->url(array('plugin' => 'notifications', 'controller' => 'notifications', 'action' => 'read', $data['id'])); ?>">
        <div>
            <div class="avatar pull-left">
                <?php echo $this->Html->image($data['avatar']); ?>
            </div>
            <div class="message">
                <?php echo $data['message']; ?>
            </div>
            <div class="timestamp">
                <?php echo $data['time']; ?>
            </div>
            <div style="clear: both;"></div>
        </div>
    </a>
    <?php echo $this->Html->link('x', array('plugin' => 'notifications', 'controller' => 'notifications', 'action' => 'delete', $data['id']), array('class' => 'deletelink')); ?>
</li>