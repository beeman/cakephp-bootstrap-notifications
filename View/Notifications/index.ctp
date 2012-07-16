<?php
echo $this->Element('Titlebar', array(
    'title' => 'My Notifications',
    'buttons' => array(
        'Delete all' => array(
            'url' => array('action' => 'deleteall'),
            'params' => array('class' => 'btn btn-success'),
        ),
        'Mark all read' => array(
            'url' => array('action' => 'markallread'),
            'params' => array('class' => 'btn btn-success'),
        ),
    )
));
?>
<table class="table table-striped table-bordered">
    <tr>
        <th colspan="2"><?php echo $this->Paginator->sort('name', 'Naam'); ?></th>
    </tr>
    <?php foreach ($data as $item): ?>
        <tr>
            <td>
                <?php if (isset($item['Sender']['name']))  :?>
                    <b><?php echo $item['Sender']['name']; ?></b>: 
                <?php endif; ?>
                <?php echo $this->Html->link($item['Notification']['name'], array('action' => 'read', $item['Notification']['id']), array('escape' => false)); ?>
                , 
                <?php echo $this->Time->niceShort($item['Notification']['created']); ?>
                <div class="pull-right">
                    <?php
                    echo $this->Form->postLink(
                            "<i class='icon-remove'></i>", array('action' => 'delete', $item['Notification']['id']), array('escape' => false), __('Weet je zeker dat je \'%s\' wil verwijderen?', $item['Notification']['name'])
                    );
                    ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
