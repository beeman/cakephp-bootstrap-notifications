<?php
if ($result) {
    foreach ($result as $res) {

        $id = $res['Notification']['id'];
        $time = $this->Time->timeAgoInWords($res['Notification']['created']);


        $message = "";
        if (isset($res['Sender']['name'])) {
            $message = "<b>{$res['Sender']['name']}</b> ";
        } else {
            $message = "&nbsp;";
        }

        if (isset($res['Notification']['message'])) {
            $message = "$message {$res['Notification']['message']}";
        } else {
            $message = "$message <br/>";
        }

        if ($res['Notification']['is_read']) {
            $is_read = '';
        } else {
            $is_read = 'unread';
        }
        ?>
        <li id="<?php echo $id; ?>" class="notification-item <?php echo $is_read; ?>">
            <a id="<?php echo $id; ?>" href="<?php echo $this->Html->url(array('controller' => 'notifications', 'action' => 'read', $id)); ?>">
                <div>
                    <div class="avatar">
                        <?php echo $this->Html->image('/notifications/img/avatar.jpg'); ?>
                    </div>
                    <?php echo $message; ?>
                    <div class = "timestamp"><?php echo $time; ?></div>
                </div>
            </a>
        </li>
        <?php
    }
} else {
    ?>
    <li class="notification-item" style = "text-align: center;">
        <a href="#"><h4>No unread notifications</h4></a>
    </li>
    <?php
}
?>
<li class="divider"></li>
<li class="notification-item" style="text-align: center;">
    <?php
    echo $this->Html->link('All notifications', array('controller' => 'notifications', 'action' => 'index'));
    ?>
</li>