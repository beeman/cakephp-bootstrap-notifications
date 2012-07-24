<?php // Notification icon ?>
<div class="notifications notification-icon btn-group pull-right">
    <a id="notification-icon" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-info-sign"></i>
        <span class="notification-counter" id="notification-counter" style="display: none;">0</span>
    </a>
    <ul id="notification-items" class="dropdown-menu">
        <?php if (isset($clear_notifications)): ?>
            <li class="notification-button">
                <?php echo $this->Html->link('Clear Notifications', array('plugin' => 'notifications', 'controller' => 'notifications', 'action' => 'markallread'), array('class' => '')); ?>
            </li>
            <li class="divider"></li>
        <?php endif; ?>
        <li id="notification-spinner">
            <?php echo $this->Html->image('/notifications/img/loading.gif'); ?>
        </li>
        <?php if (isset($all_notifications)): ?>
            <li class="divider"></li>
            <li class="notification-button">
                <?php
                echo $this->Html->link('All notifications', $all_notifications);
                ?>
            </li>
        <?php endif; ?>
    </ul>
</div>