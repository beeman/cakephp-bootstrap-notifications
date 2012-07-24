<?php
$data['id'] = $notification['Notification']['id'];
$data['time'] = $this->Time->timeAgoInWords($notification['Notification']['created']);
$data['sender'] = $notification['Sender']['name'];

$data['message'] = "";
if (isset($notification['Sender']['name'])) {
    $data['message'] = "<b>{$notification['Sender']['name']}</b> ";
}

if (isset($notification['Notification']['message'])) {
    $data['message'] = "{$data['message']}{$notification['Notification']['message']}";
}

if ($notification['Notification']['is_read']) {
    $data['is_read'] = '';
} else {
    $data['is_read'] = 'unread';
}

if (isset($notification['Sender']['email'])) {
    $email = md5(strtolower(trim($notification['Sender']['email'])));
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