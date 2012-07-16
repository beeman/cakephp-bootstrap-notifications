<div class="notifications btn-group pull-right">
    <a id="notification-icon" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-info-sign"></i>
        <span class="notification-counter" id="notification-counter" style="display: none;">0</span>
    </a>
    <ul id="notification-items" class="dropdown-menu">
        <li class="notification-button">
            <?php echo $this->Html->link('Clear Notifications', array('controller' => 'notifications', 'action' => 'markallread'), array('class' => '')); ?>
        </li>
        <li class="divider"></li>
        <li id="notification-spinner">
            <?php echo $this->Html->image('/notifications/img/loading.gif'); ?>
        </li>
        <li class="divider"></li>
        <li class="notification-button">
            <?php
            echo $this->Html->link('All notifications', $notification_url);
            ?>
        </li>
    </ul>
</div>