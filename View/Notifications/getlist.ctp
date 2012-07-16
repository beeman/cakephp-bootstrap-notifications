<?php
if ($result) {
    foreach ($result as $notification) {
        echo $this->Element('Notifications.NotificationItem', array('notification' => $notification));
    }
} else {
    ?>
    <li class="notification-button">
        <a href="#"><h4>No notifications</h4></a>
    </li>
    <?php
}
?>