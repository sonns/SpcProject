
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="#"><?php echo $this->Html->image('AdminTheme./assets/img/spc-logo-transparent.png', ['alt' => 'SPC COMPANY','width'=>'100']);?></a></h1>
        </div>
        <button class="button-menu-mobile open-left">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-collapse2">
                <ul class="nav navbar-nav hidden-xs">
                    <li class="language_bar dropdown hidden-xs">

<!--                        --><?php //echo  $this->Form->select(
//                            'sltCategory',
//                            $ddlLanguage,
//                            [
//                                'empty' => 'Select Category',
//                                'class' => 'dropdown-menu pull-right',
//                                'name'=> 'sltCategory',
//                                'id'=> 'sltCategory'
//
//                            ]
//                        );?>


                        <a href="#" id="languageValue" class="dropdown-toggle" data-toggle="dropdown"><?= $selectLanguage.' ' ;?><i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu pull-right" id="ddlLanguage">
                            <?php foreach ($ddlLanguage as $key => $language):?>
                                <li data-value="<?= $key;?>" data-name="<?= $language?>"><a href="#"><?= $language;?></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right top-navbar">
                    <li class="dropdown iconify hide-phone">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><?php if($arrNotification['count']){ ?> <span class="label label-danger absolute"><?= $arrNotification['count']?></span><?php }?></a>
<!--                        <ul class="dropdown-menu dropdown-message">-->
<!--                            <li  class="dropdown-header notif-header" style="float: left;background:#ABB7B7;padding: 6px 8px 5px;color: #fff;width: 300px;display: block;"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></li>-->
<!--                        </ul>-->
<!--                        <div style="float: left;background:#ABB7B7;padding: 6px 8px 5px;color: #fff;width: 300px;display: block;" class="dropdown-header notif-header"><i class="icon-bell-2"></i> New Notifications<a class="pull-right" href="#"><i class="fa fa-cog"></i></a></div>-->
                        <ul class="dropdown-menu dropdown-message">
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
                                        <p><?= $notification->body; ?></strong>
                                            <br /><i class="livetimestamp" data-value="<?= $notification->created;?>"></i>
                                        </p>
                                    </a>
                                </li>
                            <?php }}?>
                            <li class="dropdown-footer">
                                <div class="btn-group btn-group-justified">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="icon-ccw-1"></i> Refresh</a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-danger"><i class="icon-trash-3"></i> Clear All</a>
                                    </div>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-success">See All <i class="icon-right-open-2"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
<!--                    <li class="dropdown iconify hide-phone">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-danger absolute">3</span></a>-->
<!--                        <ul class="dropdown-menu dropdown-message">-->
<!--                            <li class="dropdown-header notif-header"><i class="icon-mail-2"></i> New Messages</li>-->
<!--                            <li class="unread">-->
<!--                                <a href="#" class="clearfix">-->
<!--                                    --><?php //echo $this->Html->image('AdminTheme./images/users/chat/2.jpg', array('class' => 'xs-avatar ava-dropdown','alt'=>'Avatar'));?>
<!--                                    <strong>John Doe</strong><i class="pull-right msg-time">5 minutes ago</i><br />-->
<!--                                    <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="unread">-->
<!--                                <a href="#" class="clearfix">-->
<!--                                    --><?php //echo $this->Html->image('AdminTheme./images/users/chat/1.jpg', array('class' => 'xs-avatar ava-dropdown','alt'=>'Avatar'));?>
<!--                                    <strong>Sandra Kraken</strong><i class="pull-right msg-time">22 minutes ago</i><br />-->
<!--                                    <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#" class="clearfix">-->
<!--                                    --><?php //echo $this->Html->image('AdminTheme./images/users/chat/3.jpg', array('class' => 'xs-avatar ava-dropdown','alt'=>'Avatar'));?>
<!--                                    <strong>Zoey Lombardo</strong><i class="pull-right msg-time">41 minutes ago</i><br />-->
<!--                                    <p>Duis autem vel eum iriure dolor in hendrerit ...</p>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="dropdown-footer"><div class=""><a href="#" class="btn btn-sm btn-block btn-primary"><i class="fa fa-share"></i> See all messages</a></div></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                    <li class="dropdown topbar-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image">
                                <?php echo $this->Html->image( (empty($userInfo['profile'])) ? 'AdminTheme./images/users/user-35.jpg' : '../file/profile/'.$userInfo['profile']['photo'] , array('class' => 'xs-avatar ava-dropdown','style'=> 'height:34px !important','alt'=>'Avatar'));?>
                                </span> <strong><?php echo $userInfo['first_name'] . ' ' .$userInfo['last_name'] ;?></strong> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'profile'])?>">My Profile</a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
<?php $this->Html->scriptStart(['block' => 'scriptBlock']);?>
$("#ddlLanguage a").on("click", function(e){
    e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("select").siblings().removeClass("select");
    console.log($this.data);
    $("#languageValue").html($this.data("name")+' <i class=\"fa fa-caret-down\"></i>');
    // Call ajax
    $.ajax({
    type: "GET",
    url:   "/AuthMaster/changeLanguage.json",
    dataType: 'text',
    data:  'keyLanguage='+$this.data("value"),
    success: function(data)
    {
        console.log(data);
        location.reload();
    }
    })
})
<?php $this->Html->scriptEnd(); ?>


<!--    $("form[name=size-form]").submit(function(e) {-->
<!--    //do your validation here-->
<!--    if ($(this).find("li.select").length == 0) {-->
<!--    alert( "Please select a size." );-->
<!--    e.preventDefault();-->
<!--    }-->
<!--    });-->
