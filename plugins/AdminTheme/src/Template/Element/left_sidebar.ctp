<div class="sidebar-inner slimscrollleft">
    <!-- Search form -->
    <form role="search" class="navbar-form">
        <div class="form-group">
            <input type="text" placeholder="Search" class="form-control">
            <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <div class="clearfix"></div>
    <!--- Profile -->
    <div class="profile-info">
        <div class="col-xs-4">
            <a href="profile.html" class="rounded-image profile-image">
<!--                --><?php //echo $this->Html->image('AdminTheme./images/users/user-100.jpg');?>
                <?php echo $this->Html->image((empty($userInfo['profile'])) ? 'AdminTheme./images/users/user-100.jpg' : '../file/profile/'.$userInfo['profile']['photo'] , array(  'alt'=>'User avatar'));?>
            </a>
        </div>
        <div class="col-xs-8">
            <div class="profile-text">Welcome <b><?php echo $userInfo['first_name']?></b></div>
            <div class="profile-buttons">
                <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                <a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>
                <a title="Sign Out"  class="md-trigger" data-modal="logout-modal"><i class="fa fa-power-off text-red-1"></i></a>
            </div>
        </div>
    </div>
    <!--- Divider -->
    <div class="clearfix"></div>
    <hr class="divider" />
    <div class="clearfix"></div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            <?php
//                print_r($sidebar);exit;
            foreach ($sidebar as $menu){
                    if ($menu['hasPermission'] >= 1) {
                        ?>
                        <li class='<?= (isset($menu['children']) && count($menu['children']) > 0) ? 'has_sub' : ''; ?>'>
                            <a href='<?= (isset($menu['children']) && count($menu['children']) > 0) ? 'javascript:void(0);' : $this->Url->build($menu['url']); ?>'>
                                <i class='icon-home-3'></i><span><?= $menu['title'] ?></span>
                                <?php if (isset($menu['children']) && count($menu['children']) > 0): ?>
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                <?php endif; ?>
                            </a>
                            <?php if (isset($menu['children']) && count($menu['children']) > 0) : ?>
                                <ul>
                                    <?php foreach ($menu['children'] as $child): ?>
                                        <li>
                                            <a href='<?= $this->Url->build($child['url']); ?>'><span><?= $child['title']; ?></span></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        <?php
                    }}
            ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="portlets">
        <div id="chat_groups" class="widget transparent nomargin">
            <h2>Chat Groups</h2>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <li><a href="javascript:;"><i class="fa fa-circle-o text-red-1"></i> Company 1</a></li>
                    <li><a href="javascript:;"><i class="fa fa-circle-o text-blue-1"></i> Company 2</a></li>
                    <li><a href="javascript:;"><i class="fa fa-circle-o text-green-1"></i> Company 3</a></li>
                </ul>
            </div>
        </div>

        <div id="recent_tickets" class="widget transparent nomargin">
            <h2>Recent Tickets</h2>
            <div class="widget-content">
                <ul class="list-unstyled">
                    <li>
                        <a href="javascript:;">My wordpress blog is broken <span>I was trying to save my page and...</span></a>
                    </li>
                    <li>
                        <a href="javascript:;">Server down, need help!<span>My server is not responding for the last...</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div><br><br><br>
</div>