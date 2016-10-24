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
                <?php echo $this->Html->image(( !isset($userInfo['profile']['photo']) ||  empty($userInfo['profile']['photo'])) ? 'AdminTheme./images/users/user-100.jpg' : '../file/profile/'.$userInfo['profile']['photo'] , array(  'alt'=>'User avatar'));?>
            </a>
        </div>
        <div class="col-xs-8">
            <div class="profile-text">Welcome <b><?php echo  (empty($userInfo['profile'])) ? $userInfo['username'] : $userInfo['profile']['first_name'] . ' ' . $userInfo['profile']['last_name'];?></b></div>
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
                            <a class="<?= ($menu['active']) ? 'active' : ''?>" href='<?= (isset($menu['children']) && count($menu['children']) > 0) ? 'javascript:void(0);' : $this->Url->build($menu['url']); ?>'>
                                <i class='icon-home-3'></i><span><?= $menu['title'] ?></span>
                                <?php if (isset($menu['children']) && count($menu['children']) > 0): ?>
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                <?php endif; ?>
                            </a>
                            <?php if (isset($menu['children']) && count($menu['children']) > 0) : ?>
                                <ul>
                                    <?php foreach ($menu['children'] as $child): ?>
                                        <?php if($child['hasPermission']){?>
                                        <li>
                                            <a  class="<?= ($child['active']) ? 'active' : ''?>" href='<?= $this->Url->build($child['url']); ?>'><span><?= $child['title']; ?></span></a>
                                        </li>
                                        <?php }?>
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
    <div class="clearfix"></div><br><br><br>
</div>