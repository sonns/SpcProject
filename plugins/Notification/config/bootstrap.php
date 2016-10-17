<?php
use Cake\Core\Configure;
Configure::write('Notification.templates.default', [
    'title' => ':title',
    'body' => ':body',
    'link' => ':link'
]);
Configure::write('Notification.templates.notifierRequest', [
    'title' => ':title',
    'body' => ':username '.__('new_post').' :category',
    'link' => ':link'
]);
Configure::write('Notification.templates.notifierForManager', [
    'title' => ':title',
    'body' => ':username '.__('new_post').' :category .'.__('request_approve_by').': :subManagerName',
    'link' => ':link'
]);
//send all user have role staff and sub-manager
Configure::write('Notification.templates.notifierByManager', [
    'title' => ':title',
    'body' => ':managerName '.__('approve_post').' ":title" :category ',
    'link' => ':link'
]);
Configure::write('Notification.templates.rejectByManager', [
    'title' => ':title',
    'body' => ':managerName '.__('rejected_post').' ":title" :category ',
    'link' => ':link'
]);
Configure::write('Notification.templates.notifierBySubManager', [
    'title' => ':title',
    'body' => ':subManagerName '.__('approve_post').' ":title" :category',
    'link' => ':link'
]);
Configure::write('Notification.templates.rejectBySubManager', [
    'title' => ':title',
    'body' => ':subManagerName '.__('rejected_post').' ":title" :category',
    'link' => ':link'
]);
Configure::write('Notification.templates.notifierForTopHead', [
    'title' => ':title',
    'body' => ':username '.__('new_post').' :category .
    '.__('request_approve_by').': :managerName',
    'link' => ':link'
]);
Configure::write('Notification.templates.notifierForTop', [
    'title' => ':title',
    'body' => ':username '.__('new_post').' :category .'.__('request_approve_by').': :managerName and :subManagerName',
    'link' => ':link'
]);
//send all user have role from staff to manager
Configure::write('Notification.templates.notifierByTop', [
    'title' => ':title',
    'body' => ':topName '.__('approve_post').' ":title" :category',
    'link' => ':link'
]);
Configure::write('Notification.templates.rejectByTop', [
    'title' => ':title',
    'body' => ':topName '.__('rejected_post').' ":title" :category',
    'link' => ':link'
]);