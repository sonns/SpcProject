<li class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>
<?php if(!count($arrNotification['notificationList'])){?>
    <li class="unread">
        <a href="#">
            <p><?= __('No Data')?></p>
        </a>
    </li>
<?php }else{
    foreach ($arrNotification['notificationList'] as $key => $notification){
        ?>
        <li class="unread">
            <a href="#">
                <p>
                    <?php if(!empty($notification->link)){ ?> <a href="<?php echo $notification->link; ?>"> <?= $notification->body; ?></a><?php }else{ echo $notification->body;} ?>

                    <br /><i class="livetimestamp" data-value="<?= $notification->created;?>"></i>
                </p>
            </a>
        </li>
    <?php }}?>
<li class="dropdown-footer">
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <a class="btn btn-sm btn-primary refresh"><i class="icon-ccw-1"></i> Refresh</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-sm btn-danger clear-all"><i class="icon-trash-3"></i> Clear All</a>
        </div>
        <div class="btn-group">
            <a href="<?= $this->Url->build(['controller'=>'Notifications','action' =>'index'])?>" class="btn btn-sm btn-success">See All <i class="icon-right-open-2"></i></a>
        </div>
    </div>
</li>