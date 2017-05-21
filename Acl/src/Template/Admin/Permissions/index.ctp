<?php

$this->extend('Croogo/Core./Common/admin_index');

$this->Croogo->adminScript('Croogo/Acl.acl_permissions');

$this->Breadcrumbs->add(__d('croogo', 'Users'),
        ['plugin' => 'Croogo/Users', 'controller' => 'Users', 'action' => 'index'])
    ->add(__d('croogo', 'Permissions'), $this->request->getUri()->getPath());

$this->append('action-buttons');
$toolsButton = $this->Html->link(__d('croogo', 'Tools'), '#', [
        'button' => 'secondary',
        'class' => 'dropdown-toggle',
        'data-toggle' => 'dropdown',
        'escape' => false,
    ]);

$generateUrl = [
    'plugin' => 'Croogo/Acl',
    'controller' => 'Actions',
    'action' => 'generate',
    'permissions' => 1,
];
$out = $this->Croogo->adminAction(__d('croogo', 'Generate'), $generateUrl, [
        'button' => false,
        'list' => true,
        'method' => 'post',
        'class' => 'dropdown-item',
        'tooltip' => [
            'data-title' => __d('croogo', 'Create new actions (no removal)'),
            'data-placement' => 'right',
        ],
    ]);
$out .= $this->Croogo->adminAction(__d('croogo', 'Synchronize'), $generateUrl + ['sync' => 1], [
        'button' => false,
        'list' => true,
        'method' => 'post',
        'class' => 'dropdown-item',
        'tooltip' => [
            'data-title' => __d('croogo', 'Create new & remove orphaned actions'),
            'data-placement' => 'right',
        ],
    ]);
echo $this->Html->div('btn-group', $toolsButton . $this->Html->div('dropdown-menu', $out));

echo $this->Croogo->adminAction(__d('croogo', 'Edit Actions'),
    ['controller' => 'Actions', 'action' => 'index', 'permissions' => 1]);
$this->end();

$this->Js->buffer('AclPermissions.tabSwitcher();');

?>
<div class="<?php echo $this->Theme->getCssClass('row'); ?>">
    <div class="<?php echo $this->Theme->getCssClass('columnFull'); ?>">

        <ul id="permissions-tab" class="nav nav-tabs">
        <?php
            echo $this->Croogo->adminTabs();
        ?>
        </ul>

        <div class="tab-content">
            <?php echo $this->Croogo->adminTabs(); ?>
        </div>

    </div>
</div>
