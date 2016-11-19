<li class="dropdown-header notif-header"><i class="icon-bell-2"></i><?=__('new_noti')?><a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>
<?php if(!count($arrNotification['notificationList'])){?>
    <li class="unread">
        <a href="#">
            <p><?= __('no_data')?></p>
        </a>
    </li>
<?php }else{
    foreach ($arrNotification['notificationList'] as $key => $notification){
        ?>
        <li class="unread">
            <a href="<?= !empty($notification->link)? $notification->link : ''; ?>">
                <p>
                    <?php echo $notification->body; ?>

                    <br /><i class="livetimestamp" data-value="<?= $notification->created;?>"></i>
                </p>
            </a>
        </li>
    <?php }}?>
<li class="dropdown-footer">
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <a class="btn btn-sm btn-primary refresh"><i class="icon-ccw-1"></i><?=__('refresh')?></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-sm btn-danger clear-all"><i class="icon-trash-3"></i> <?=__('clear_all')?></a>
        </div>
        <div class="btn-group">
            <a href="<?= $this->Url->build(['controller'=>'Notifications','action' =>'index'])?>" class="btn btn-sm btn-success"><?=__('see_all')?><i class="icon-right-open-2"></i></a>
        </div>
    </div>
</li>