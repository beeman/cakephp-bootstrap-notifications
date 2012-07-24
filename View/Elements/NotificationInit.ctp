<?php if (AuthComponent::user('id')) : ?>
    <script>
        var interval = 3000;
        var pagetitle = "";
        var userid = '<?php echo AuthComponent::user('id'); ?>';
        var count_url = '<?php echo $this->Html->url(array('plugin' => 'notifications', 'controller' => 'notifications', 'action' => 'getcount')); ?>';
        var list_url = '<?php echo $this->Html->url(array('plugin' => 'notifications', 'controller' => 'notifications', 'action' => 'getlist')); ?>';
        $(document).ready(function(){
            startNotifications();
        });
    </script>
<?php endif; ?>