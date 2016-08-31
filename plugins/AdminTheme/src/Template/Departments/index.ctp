<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> Department List</h1>
<!-- Page Heading End-->


    <div class="md-modal md-slide-stick-top" id="form-modal">
        <div class="md-content">
            <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
            <h3><strong>Form</strong> Modal</h3>
            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Login</h4>
                        <form role="form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h4>Not a member?</h4>
                        <p>Create account <a href="#fakelink">here</a></p>
                        <p>OR</p>

                        <button type="button" class="btn btn-primary btn-sm btn-block btn-facebook"><i class="fa fa-facebook"></i> Login with Facebook</button>
                        <button type="button" class="btn btn-primary btn-sm btn-block btn-twitter"><i class="fa fa-twitter"></i> Login with Twitter</button>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- End .md-modal -->


    <!-- Your awesome content goes here -->

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header transparent">
                <div class="additional-btn">
                    <a href="<?php echo $this->Url->build(['controller'=>'departments','action'=>'add','add_dep'])?>" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="<?php echo $this->Url->build(['controller'=>'departments','action'=>'delete','del_dep'])?>" class="widget-toggle"><i class="icon-down-open-2"></i></a>
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
                                <a href="<?php echo $this->Url->build(['controller'=>'departments','action'=>'add','dep_add'])?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                                <a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
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
                            <th>Department Name</th>
                            <th>Tel</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th data-sortable="false">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($departments as $key => $department): ?>
                            <tr>
                                <td><?php echo $key+1;?></td><td><input type="checkbox" class="rows-check"></td>
                                <td><strong><?php echo $department->name;?></strong></td>
                                <td><strong><?php echo $department->tel;?></strong></td>
                                <td><strong><?php echo $department->address;?></strong></td>
                                <td><strong><?php echo $department->status;?></strong></td>
                                <td><strong><?php echo $department->created;?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-edit')),array('controller'=>'departments','action'=>'edit','edit_dep'),array('style' => 'margin-right:4px;' ,'class'=>'btn btn-default','title'=>'Edit','data-toggle'=>"tooltip",'escape' => false ))?>
                                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-remove')),array('controller'=>'departments','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false ))?>
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
    Huban Creative &copy; 2014
    <div class="footer-links pull-right">
        <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
    </div>
</footer>
<!-- Footer End -->
