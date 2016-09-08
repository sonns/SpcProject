
<div class="row">
        <div class="col-md-12 portlets">
            <div class="col-md-3">
                <!-- Sidebar Message -->
                <div class="btn-group new-message-btns stacked">
                    <p class="btn btn-success btn-lg col-xs-12">Configuration</p>
                </div>
                <div class="list-group menu-message">
                    <a class="list-group-item active"><i class="icon-inbox"></i> <?php echo __('Role');?></a>
                    <a class="list-group-item active"><i class="icon-inbox"></i> <?php echo __('General');?></a>
                    <a class="list-group-item"><i class="icon-pencil"></i> <?php echo __('System');?></a>
                    <a class="list-group-item"><i class="icon-star"></i> <?php echo __('Register & Login');?></a>
                    <a class="list-group-item"><i class="icon-export"></i> <?php echo __('Permission');?></a>
                </div>
            </div><!-- ENd div .col-md-2 -->
            <div class="col-sm-9">
                <div class="widget widget-tabbed">
                    <!-- Nav tab -->
                    <ul class="nav nav-tabs nav-justified">

                        <li class="active"><a href="#Role" data-toggle="tab"><i class="fa fa-user"></i> Role</a></li>
                        <li><a href="#reset_password" data-toggle="tab"><i class="fa fa-pencil"></i> Reset Password</a></li>
                        <li><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Activities</a></li>
                        <li><a href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i> Message</a></li>
                    </ul>
                    <!-- End nav tab -->

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Tab about -->
                        <?php echo $this->element('Configuration/role') ?>
                        <!-- End Tab about -->
                        <div class="tab-pane animated fadeInRight" >
                            <?php echo $this->element('User/empty') ?>
                        </div>
                        <!-- Tab user activities -->
                        <?php echo $this->element('User/empty') ?>
                        <!-- End Tab user activities -->
                        <!-- Tab user messages -->
                        <?php echo $this->element('User/empty') ?>
                        <!-- End Tab user messages -->
                    </div><!-- End div .tab-content -->
                </div><!-- End div .box-info -->
            </div>
        </div>
</div>