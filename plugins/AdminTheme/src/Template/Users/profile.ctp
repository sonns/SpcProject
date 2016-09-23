<!-- Page Heading End-->
<div class="row">
    <div class="col-sm-3 portlets">
        <div class="avatar-container">
            <?php echo $this->Html->image((empty($userInfo['profile'])) ? 'AdminTheme./images/users/user-256.jpg' : '../file/profile/'.$userInfo['profile']['photo'] , array('class' => 'img-circle profile-avatar','alt'=>'User avatar'));?>
        </div>
        <!-- Begin user profile -->
        <?= $this->cell('User::display', [$userInfo] )?>
    </div>
    <div class="col-sm-9">
        <div class="widget widget-tabbed">
            <!-- Nav tab -->
            <ul class="nav nav-tabs nav-justified">

                <li  class="active"><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> About</a></li>
                <li><a href="#reset_password" data-toggle="tab"><i class="fa fa-pencil"></i> Reset Password</a></li>
                <li><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Activities</a></li>
                <li><a href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i> Message</a></li>
            </ul>
            <!-- End nav tab -->

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Tab about -->
                <?php echo $this->element('User/profile') ?>
                <!-- End Tab about -->
                <div class="tab-pane animated fadeInRight" id="reset_password">
                    <?php echo $this->element('User/change_password') ?>
                </div>
<!--                <!-- Tab user activities -->
<!--                --><?php //echo $this->element('User/activities') ?>
<!--                <!-- End Tab user activities -->
<!--                <!-- Tab user messages -->
                <!--                --><?php //echo $this->element('User/mymessage') ?>
                <!-- End Tab user messages -->
            </div><!-- End div .tab-content -->
        </div><!-- End div .box-info -->
    </div>
</div>

<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>