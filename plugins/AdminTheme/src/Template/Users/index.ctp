<!-- Modal add department-->
<?php echo $this->element('User/add') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> Users List</h1>
    <!-- Page Heading End-->
    <!-- Your awesome content goes here -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <div class="additional-btn">
                        <a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'add','add_user'])?>" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'delete','del_user'])?>" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content">

                    <div class="data-table-toolbar">

                        <div class="row">

                            <div class="col-md-4">

                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="toolbar-btn-action">
                                    <a data-modal="md-add-department" class="btn btn-success md-trigger"><i class="fa fa-plus-circle"></i>Add new</a>
                                    <a data-modal="md-add-department" class="btn btn-danger md-trigger"><i class="fa fa-trash-o"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
                                <th>Name</th>
                                <th>email</th>
                                <th>username</th>
                                <th>confirmed</th>
                                <th>Created Date</th>
                                <th data-sortable="false">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?php echo $key+1;?></td><td><input type="checkbox" class="rows-check"></td>
                                    <td><strong><?php echo $user->first_name.' '. $user->last_name;?></strong></td>
                                    <td><strong><?php echo $user->email;?></strong></td>
                                    <td><strong><?php echo $user->username;?></strong></td>
                                    <td> <span class="label <?php echo ($user->confirmed) ? 'label-success' :'label-danger' ?>"><?php echo ($user->confirmed) ? 'Active' :'Suspended' ?></span></td>
                                    <td><strong><?php echo $user->created;?></strong></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-edit')),array('controller'=>'users','action'=>'edit','edit_dep'),array('style' => 'margin-right:4px;' ,'class'=>'btn btn-default','title'=>'Edit','data-toggle'=>"tooltip",'escape' => false ))?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-remove')),array('controller'=>'users','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false ))?>
                                            <!--                                        <a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>-->
                                            <!--                                        <a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>-->
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="data-table-toolbar">
                        <ul class="pagination" style="margin-bottom: 8px;">
                            <?php echo $this->Paginator->prev('«',  array('class' => 'disabled')); ?>
                            <!--                        --><?php //echo $this->Paginator->numbers(array('before' => '<span class="pagenumber">')); ?>
                            <?php echo $this->Paginator->numbers(['first' => 4, 'last' => 2]); ?>
                            <?php echo $this->Paginator->next('»', array('class' => 'disabled')); ?>
                        </ul>
                        <p style="marrgin-left:40px;"><?php echo $this->Paginator->counter(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <footer>
        Son Nguyen &copy; 2014
        <div class="footer-links pull-right">
            <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
        </div>
    </footer>