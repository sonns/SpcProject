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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i> Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu primary" role="menu">
                                        <li class="requestAction" data-mode="multiApp"><a href="javascript:;">Approve</a></li>
                                        <li class="requestAction" data-mode="multiRej"><a href="javascript:;">Reject</a></li>
                                        <li class="requestAction" data-mode="multiDel"><a href="javascript:;">Delete</a></li>
                                        <li class="divider"></li>
                                        <li><a  data-modal="md-add-request" class="md-trigger" >Add new</a></li>
                                    </ul>
                                </div>
<!--                                <a data-modal="md-add-request" class="btn btn-success md-trigger"><i class="icon-ok-circled"></i> Add new</a>-->
<!--                                <a data-modal="md-add-request" class="btn btn-success md-trigger"><i class="fa fa-plus-circle"></i> Add new</a>-->
<!--                                <a data-modal="md-add-request" class="btn btn-danger md-trigger"><i class="icon-eye-off"></i> Delete</a>-->
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
                            <th style="width: 30px"><input id="checkAll" type="checkbox" class="rows-check"></th>
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
                                <td><?php echo $key+1;?></td>
                                <td><input value="<?= $request->id; ?>" name="request_id[]" type="checkbox" class="rows-check"></td>
                                <td><strong><?php echo $request->user->alias_name;?></strong></td>
                                <td><strong><?php echo $request->department->name;?></strong></td>
                                <td><strong><?php echo $request->category->name;?></strong></td>
                                <td><strong><?php echo $request->title;?></strong></td>
                                <td><strong><?php echo $request->appr_date;?></strong></td>
                                <td> <span class="requestStatus label <?php echo ($request->status) ? 'label-success' :'label-danger' ?>"><?php echo ($request->status) ? 'Active' :'Pending' ?></span></td>
                                <td><strong><?php echo $request->created;?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php if($request->status !==  1){ ?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-ok-circled')),'javascript:;',array('style' => 'margin-right:4px;' ,'class'=>'btn btn-success statusRequest','title'=>'Approve','data-toggle'=>"tooltip",'escape' => false ,'data-value'=>$request->id,'data-mode' => 'app' ))?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-cancel-circled')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Reject','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'rej'  ))?>
                                        <?php }else{ ?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'del'  ))?>
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
                        <?php echo $this->Paginator->numbers(['first' => 2, 'last' => 2]); ?>
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

<?php
$this->Html->scriptEnd();
?>

<script>

    $('#checkAll')
        .on('ifChecked', function(event) {
            $("input[name='request_id[]']").iCheck('check');
        })
        .on('ifUnchecked', function() {
            $("input[name='request_id[]']").iCheck('uncheck');
        });

    $(".approveRequest").on("click", function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: "GET",
            url:   "request/change_status.json",
            dataType: 'text',
            data:  'request_id='+$this.data("value")+'&mod='+$this.data("mode"),
            success: function(data)
            {
                $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').addClass('label-success').text('Active');
                var btnAction = $this.parent();
                btnAction.empty();
                btnAction.html('<?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'del'  ))?>');
                console.log(data);
            }
        })
    })

    $(".requestAction").on("click", function(e){
        e.preventDefault();
//        $(this).reloadList('ok');
//        return;
        var $this = $(this);
        var values = new Array();
        $.each($("input[name='request_id[]']:checked"), function() {
            values.push( $(this).val());
        });
        console.log(values);
        console.log( 'request_id='+values.join()+'&mod='+$this.data("mode"));
        $.ajax({
            type: "GET",
            url:   "request/change_status.json",
            dataType: 'text',
            data:  'request_id='+values.join()+'&mod='+$this.data("mode"),
            success: function(data)
            {
                var returnedData = JSON.parse(data);
                if(returnedData.result.status === 'Success'){
                    $.each($("input[name='request_id[]']:checked"), function() {
                        if($this.data("mode") === 'multiDel'){
                            $(this).parents(':eq(2)').empty();
                        }else{
                            $(this).parents(':eq(2)').find('.requestStatus').removeClass('label-danger').addClass('label-success').text('Active');
                            $(this).parents(':eq(2)').find('.btn-group').empty();
                            $(this).parents(':eq(2)').find('.btn-group').html('<?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'del'  ))?>');
                        }

                    });
                }
                console.log(data);
            }
        })
    })


    $.fn.reloadList = function($param) {
        alert($param);

    };


</script>
