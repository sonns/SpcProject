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
                            <th width="92px;" data-sortable="false">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($requests as $key => $request): ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td><input value="<?= $request->id; ?>" name="request_id[]" type="checkbox" class="rows-check"></td>
                                <td><strong><?php echo $request->alias_name;?></strong></td>
                                <td><strong><?php echo $request->department_name;?></strong></td>
                                <td><strong><?php echo $request->categories_name;?></strong></td>
                                <td><strong><?php echo $request->title;?></strong></td>
                                <td><strong><?php echo $request->appr_date;?></strong></td>
                                <?php
//                                    $isApprove = true;
                                    $status = ['class'=>'label-danger','value'=>'Rejected','status' => false];
                                    if($request->role_name === 'top' || (int)$request->top_status === 1 ||  ((int)$request->department_id === 2 && $request->role_name === 'manager')){
                                        $status = ['class'=>'label-success','value'=>'Approved','status' => false];
                                    }else{
                                        if((int)$request->department_id === 2) {
                                            if ((int)$request->manager_status === 1 && $userInfo->role[0]->name === 'manager') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'top') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            }elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'staff') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            }
                                            elseif ((int)$request->manager_status === 2 || (int)$request->top_status === 2) {
                                                $status = ['class'=>'label-danger','value'=>'Rejected','status' => false];
                                            }
                                            else
                                                $status = ['class' => 'label-warning', 'value' => 'pending', 'status' => true];
                                        }else{
                                            if ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'manager') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'sub-manager') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'top') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            }
                                            elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'staff') {
                                                $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false];
                                            }
                                            elseif ((int)$request->manager_status === 2 || (int)$request->top_status === 2 || (int)$request->sub_manager_status === 2) {
                                                $status = ['class'=>'label-danger','value'=>'Rejected','status' => false];
                                            }
                                            else
                                                $status = ['class' => 'label-warning', 'value' => 'pending', 'status' => true];
                                        }
                                    }

                                ?>
                                <td> <span class="requestStatus label <?= $status['class'] ?>"><?= $status['value'] ?></span></td>
                                <td><strong><?php echo $request->created;?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php if($userInfo->role[0]->name === 'admin' || $userInfo->role[0]->name === 'staff'){?>
                                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$request->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'del'  ))?>
<!--                                         <span class="requestStatus label label-danger">--><?//= __('No Permission!')?><!--</span>-->
                                        <?php }else{ ?>
                                            <?php if($status['status']){ ?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-ok-circled')),'javascript:;',array('style' => 'margin-right:4px;' ,'class'=>'btn btn-success statusRequest','title'=>'Approve','data-toggle'=>"tooltip",'escape' => false ,'data-value'=>$request->id,'data-mode' => 'app' ))?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-cancel-circled')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Reject','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'rej'  ))?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$request->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'pre'  ))?>
                                            <?php }else{ if(($userInfo->role[0]->name === 'manager' && (int)$request->manager_status === 1) || ($userInfo->role[0]->name === 'sub-manager' && (int)$request->sub_manager_status === 1)) ?>
<!--                                                <span class="requestStatus label label-success">--><?//= __('Approved by me!')?><!--</span>-->
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$request->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'pre'  ))?>
                                            <?php } ?>
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

    $(".statusRequest").on("click", function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: "GET",
            url:   "/request/change_status.json",
            dataType: 'text',
            data:  'request_id='+$this.data("value")+'&mod='+$this.data("mode"),
            success: function(data)
            {
                var returnedData = JSON.parse(data);
                <?php if($userInfo->role[0]->name === 'top'){?>
                    if($this.data("mode") === 'app') {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
                    }else {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    }
                <?php }else{ ?>
                    if($this.data("mode") === 'app') {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-warning').text('Pending');
                    }else {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    }
                <?php } ?>
                var btnAction = $this.parent();
                btnAction.empty();
                btnAction.html('<a href="/request/preview/'+returnedData.result.response.id+'" class="btn btn-primary" title="" data-toggle="tooltip" data-value="'+returnedData.result.response.id+'" data-mode="pre" data-original-title="Preview"><i class="icon-eye-off"></i></a>');
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
            url:   "/request/change_status.json",
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
                            $(this).parents(':eq(2)').find('.requestStatus').removeClass('label-danger').addClass('label-success').text('Approved');
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
