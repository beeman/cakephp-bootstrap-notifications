CakePHP/Bootstrap Notification plugin
===============================

This plugin is inspired by the Facebook notifications. It is to be used in CakePHP applications that use the Twitter Bootstrap user interface.

This is how it looks
----------------------

![Notification Screenshot][1]

The installation
----------------------

 - Checkout the code

`git clone git://github.com/beeman/cakephp-bootstrap-notifications.git Notifications`

or add as submodule:

`git submodule add git://github.com/beeman/cakephp-bootstrap-notifications.git plugins/Notifications`

 - Add the following line to app/Config/bootstrap.php to load the plugin

`CakePlugin::load('Notifications');`

 - Initialize the schema

`app/Console/cake schema create --plugin Notifications`

 - Add the resources to the default template (default.ctp)

`<?php echo $this->Html->css('/notifications/css/notifications'); ?>`

`<?php echo $this->Html->script('/notifications/js/notifications'); ?>`

 - Add elements for Notification Initialization to the default template (default.ctp)

`<?php echo $this->Element('Notifications.NotificationInit'); ?>`

 - Add the Notification Icon to the bootstrap navigation bar

To just show the notifications, add this line:

`<?php echo $this->Element('Notifications.NotificationIcon'); ?>`

Or add a link to clear notifications and a link to where your application shows all the notifications

```php
echo $this->Element('Notifications.NotificationIcon', array(
    'all_notifications' => array('controller' => 'dashboard', 'action' => 'notifications'),
    'clear_notifications' => true,
        )
);
```

 - Associate Notifications to User object

```php
public $hasMany = array(
    'Notification' => array(
        'className' => 'Notifications.Notification',
        'foreignKey' => 'user_id',
    ),
);
```

Adding notifications to your system
----------------------

In this example we will give the user a notification when it logs in.

Modifiy the login() method in the UsersController, enter the next rule direct below '$this->Auth->login()'

`$this->User->Notification->msg(AuthComponent::user('id'), "You logged in!");`

Now when you login you should get a notification from it.

Todo
----------------------
- Make it easy to automatically add notifications to a model
- Make it easier to add notifications from a controller
- Maybe use the JsHelper to write the Javascript that is now in View/Elements/NotificationInit.ctp ? 

  [1]: http://i.imgur.com/z7ZDw.png