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
  
  
License
-----------------------
The MIT License (MIT)

Copyright (c) 2012 Bram Borggreve

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
