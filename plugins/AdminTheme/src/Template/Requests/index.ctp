<!-- Modal add department-->
<?php echo $this->element('Request/add') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> Request List</h1>
</div>
<!-- Page Heading End-->
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
                                <a data-modal="md-add-request" class="btn btn-success md-trigger"><i class="fa fa-plus-circle"></i> Add new</a>
                                <a data-modal="md-add-request" class="btn btn-danger md-trigger"><i class="icon-eye-off"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  if(count($requests)):?>
                <div class="table-responsive">
                    <table data-sortable class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
                            <th>User</th>
                            <th>Department</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Approve-date</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th data-sortable="false">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($requests as $key => $request): ?>
                            <tr>
                                <td><?php echo $key+1;?></td><td><input type="checkbox" class="rows-check"></td>
                                <td><strong><?php echo $request->user->alias_name;?></strong></td>
                                <td><strong><?php echo $request->department->name;?></strong></td>
                                <td><strong><?php echo $request->category->name;?></strong></td>
                                <td><strong><?php echo $request->title;?></strong></td>
                                <td><strong><?php echo $request->appr_date;?></strong></td>
                                <td> <span class="label <?php echo ($request->status) ? 'label-success' :'label-danger' ?>"><?php echo ($request->status) ? 'Active' :'Pending' ?></span></td>
                                <td><strong><?php echo $request->created;?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php if($request->status !==  1){ ?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-ok-circled','id'=>'approveRequest')),array('controller'=>'departments','action'=>'edit','edit_dep'),array('style' => 'margin-right:4px;' ,'class'=>'btn btn-success','title'=>'Approve','data-toggle'=>"tooltip",'escape' => false ))?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-cancel-circled')),array('controller'=>'departments','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>'Reject','data-toggle'=>"tooltip",'escape' => false ))?>
                                        <?php }else{ ?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),array('controller'=>'departments','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false ))?>
                                        <?php } ?>
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
                <?php else:?>
                    <div>
                        <h1 style="text-align: center;" > No Data </h1>
                    </div>

                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer>
    Son Nguyen &copy; 2016
    <div class="footer-links pull-right">
<!--        <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>-->
    </div>
</footer>

<?php
$this->Html->scriptStart(['block' => 'scriptBlock']);?>
$("#ddlLanguage a").on("click", function(e){
e.preventDefault();
var $this = $(this).parent();
$this.addClass("select").siblings().removeClass("select");
console.log($this.data);
$("#languageValue").html($this.data("name")+' <i class=\"fa fa-caret-down\"></i>');
// Call ajax
$.ajax({
type: "GET",
url:   "changeLanguage.json",
dataType: 'text',
data:  'keyLanguage='+$this.data("value"),
success: function(data)
{
console.log(data);
location.reload();
}
})
})
<?php
$this->Html->scriptEnd();
?>

