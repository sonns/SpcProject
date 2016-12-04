<!-- Page Heading End-->
<div class="row">
    <div class="col-sm-3 portlets">
        <div class="avatar-container">
            <?php echo $this->Html->image(( !isset($userInfo['profile']['photo']) ||  empty($userInfo['profile']['photo'])) ? 'AdminTheme./images/users/user-256.jpg' : '../file/profile/'.$userInfo['profile']['photo'] , array('class' => 'img-circle profile-avatar','alt'=>'User avatar'));?>
        </div>
        <!-- Begin user profile -->
        <?= $this->cell('User::display', [$userInfo] )?>
    </div>
    <div class="col-sm-9">
        <div class="widget widget-tabbed">
            <!-- Nav tab -->
            <ul class="nav nav-tabs nav-justified">

                <li  class="active"><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> <?=__('about')?></a></li>
                <li><a href="#reset_password" data-toggle="tab"><i class="fa fa-pencil"></i><?__('reset_pass')?></a></li>
                <?php if($userInfo['role'][0]->name === 'admin'): ?>
<!--                    <li><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> --><?//=__('activities')?><!--</a></li>-->
<!--                    <li><a href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i>--><?//=__('message')?><!--</a></li>-->
                <?php endif; ?>

            </ul>
            <!-- End nav tab -->

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Tab about -->
                <?php echo $this->element('User/profile') ?>
                <!-- End Tab about -->
                <?php echo $this->element('User/change_password') ?>
                <?php if($userInfo['role'][0]->name === 'admin'): ?>
<!--                    --><?php //echo $this->element('User/activities') ?>
<!--                    --><?php //echo $this->element('User/mymessage') ?>
                <?php endif;?>



            </div><!-- End div .tab-content -->
        </div><!-- End div .box-info -->
    </div>
</div>

<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>
