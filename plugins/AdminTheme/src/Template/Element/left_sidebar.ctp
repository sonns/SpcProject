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
                <?php echo $this->Html->image('AdminTheme./images/users/user-100.jpg');?>
            </a>
        </div>
        <div class="col-xs-8">
            <div class="profile-text">Welcome <b><?php echo $userInfo['first_name']?></b></div>
            <div class="profile-buttons">
                <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                <a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>
                <a href="javascript:;" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
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
            <li class='has_sub'>
                <a href='javascript:void(0);'>
                    <i class='icon-home-3'></i><span>Dashboard</span>
                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                </a>
                <ul>
                    <li>
                        <a href='index.html'><span>Dashboard v1</span></a>
                    </li>
                    <li><a href='index2.html'><span>Dashboard v2</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="<?php echo (!empty($this->request->params['controller']) && ($this->request->params['controller']=='Departments') )?'active' :'' ?>" href='<?php echo $this->Url->build(['controller'=>'departments','action'=>'index'])?>'>
                    <i class='icon-home-3'></i><span>Departments</span>
                </a>
            </li>
            <li>
                <a class="<?php echo (!empty($this->request->params['controller']) && ($this->request->params['controller']=='Users') )?'active' :'' ?>" href='<?php echo $this->Url->build(['controller'=>'users','action'=>'index'])?>'>
                    <i class='icon-home-3'></i><span>Users</span>
                </a>
            </li>
            <li>
                <a class="<?php echo (!empty($this->request->params['Permission']) && ($this->request->params['controller']=='Permission') )?'active' :'' ?>" href='javascript:void(0);'>
                    <i class='icon-home-3'></i><span>Permissions</span>
                </a>
            </li>
            <li>
                <a class="<?php echo (!empty($this->request->params['Rules']) && ($this->request->params['controller']=='Rules') )?'active' :'' ?>" href='javascript:void(0);'>
                    <i class='icon-home-3'></i><span>Rules</span>
                </a>
            </li>
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