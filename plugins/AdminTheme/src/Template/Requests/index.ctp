<!-- Modal add department-->
<?php echo $this->element('Request/add') ?>
<?php echo $this->element('Request/comment') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> <?=__('request').' '.__('list')?></h1>
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
                                <input type="text" class="form-control" placeholder="<?=__('search')?>...">
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="toolbar-btn-action">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i> <?=__('action')?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu primary" role="menu">
                                        <li><a  data-modal="md-add-request" class="md-trigger" ><?=__('add_new')?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  if(count($requests)):?>
                <div class="table-responsive">
                    <table data-sortable class="table table-hover table-striped" id="listRequests">
                        <thead>
                        <tr>
                            <th><?=__('no')?></th>
                            <th><?=__('user')?></th>
                            <th><?=__('department')?></th>
                            <th><?=__('request_cate')?></th>
                            <th><?=__('title')?></th>
                            <th><?=__('request_approve_date')?></th>
                            <th><?=__('request_approve_by')?></th>
                            <th><?=__('status')?></th>
                            <th><?=__('create_date')?></th>
                            <th width="116px;" data-sortable="false"><?=__('action')?></th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($requests as $key => $request): ?>
                            <?php
                                $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=> (round( ( strtotime( $this->Time->i18nFormat($request->appr_date,'MM/dd/yyyy') ) - time() ) / 86400 ) <= 1) ? 'highlight-out-pending' : 'highlight-pending'];
                                if($request->role_name === 'top' || (int)$request->top_status === 1 ||  ((int)$request->department_id === 2 && $request->role_name === 'manager')){
                                    $status = ['class'=>'label-success','value'=>'Approved','status' => false, 'rowclass'=>'highlight-success'];
                                }else{
                                    if((int)$request->department_id === 2) {
                                        if ((int)$request->manager_status === 1 && $userInfo->role[0]->name === 'manager') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false , 'rowclass'=>'highlight-success'];
                                        } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'top') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        }elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'staff') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        }
                                        elseif ((int)$request->manager_status === 2 || (int)$request->top_status === 2) {
                                            $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=>'highlight-reject'];
                                        }
                                        else
                                            $status = ['class' => 'label-warning', 'value' => 'Pending', 'status' => true, 'rowclass'=>$status['rowclass']];
                                    }else{
                                        if ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'manager') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'sub-manager') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        } elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'top') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        }
                                        elseif ((int)$request->top_status === 1 && $userInfo->role[0]->name === 'staff') {
                                            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
                                        }
                                        elseif ((int)$request->manager_status === 2 || (int)$request->top_status === 2 || (int)$request->sub_manager_status === 2) {
                                            $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=>'highlight-reject'];
                                        }
                                        else

                                            $status = ['class' => 'label-warning', 'value' => 'Pending', 'status' => true, 'rowclass'=>$status['rowclass']];
                                    }
                                }
                            ?>
                            <tr class="<?=$status['rowclass'];?>">
                                <td><?php echo $key+1;?></td>
                                <td><strong><?php echo $request->alias_name;?></strong></td>
                                <td><strong><?php echo $request->department_name;?></strong></td>
                                <td><strong><?php echo $request->categories_name;?></strong></td>
                                <td><strong><?php echo $request->title;?></strong></td>
                                <td><strong><?= $this->Time->i18nFormat($request->appr_date,'MM/dd/yyyy');?></strong></td>
                                <td>
                                    <?php if((int)$request->top_status === 1 || (int)$request->top_status === 2){?>
                                        <strong  title="<?= ((int)$request->top_status === 2 ? 'Reject by Top' : 'Approve by Top')?>"><i class="icon-adult"></i></strong>
                                    <?php } if((int)$request->manager_status === 1 || (int)$request->manager_status === 2){ ?>
                                        <strong  title="<?= ((int)$request->manager_status === 2 ? 'Reject by Manager' : 'Approve by Manager')?>"><i class="icon-child"></i></strong>
                                    <?php } if((int)$request->sub_manager_status === 1 || (int)$request->sub_manager_status === 2){ ?>
                                        <strong  title="<?= ((int)$request->sub_manager_status === 2 ? 'Reject by Sub-Manager' : 'Approve by Sub-Manager')?>"><i class="icon-child"></i></strong>
                                    <?php } ?>
                                </td>
                                <td> <span class="requestStatus label <?= $status['class'] ?>"><?= $status['value'] ?></span></td>
                                <td><strong><?=  $this->Time->i18nFormat($request->created,'MM/dd/yyyy');?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-cog"></i> <?=__('action')?> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu primary" role="menu">
                                            <li class="requestAction" data-mode="multiApp"><a href="javascript:;"><?=__('approve')?></a></li>
                                            <li class="requestAction" data-mode="multiRej"><a href="javascript:;"><?=__('reject')?></a></li>
                                            <li class="requestAction" data-mode="multiDel">
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')) . ' '.__('preview'),'/requests/preview/'.$request->id,array('data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id  ))?>
                                                <a href="javascript:;"><?=__('preview')?></a></li>
                                            <li class="requestAction" data-mode="multiDel"><a href="javascript:;"><?=__('return')?></a></li>
                                            <li class="divider"></li>
                                        </ul>

                                        <?php if($userInfo->role[0]->name === 'admin' || $userInfo->role[0]->name === 'staff'){?>


                                        <?php }else{ ?>
                                            <?php if($status['status']){ ?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-ok-circled')),'javascript:;',array('class'=>'btn btn-success statusRequest','title'=>'Approve','data-toggle'=>"tooltip",'escape' => false ,'data-value'=>$request->id,'data-mode' => 'app' ))?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-cancel-circled')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Reject','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'rej'  ))?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$request->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id,'data-mode' => 'pre'  ))?>
                                                <a class="btn btn-primary md-trigger btnReturn" title="" data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="return" data-modal="md-add-request_comment" data-original-title="Return"><i class="fa fa-mail-forward"></i></a>
                                            <?php }else{ if(($userInfo->role[0]->name === 'manager' && (int)$request->manager_status === 1) || ($userInfo->role[0]->name === 'sub-manager' && (int)$request->sub_manager_status === 1)) ?>
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
                        <?php echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('class' => 'disabled','escape' => false)); ?>
                        <?php echo $this->Paginator->numbers(array('modulus' => 2 ,"first"=>2,'last' => 2  )); ?>
                        <?php echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('class' => 'disabled','escape' => false)); ?>
                    </ul>
                    <p style="marrgin-left:40px;"><?php echo $this->Paginator->counter(); ?></p>
                </div>
                <?php else:?>
                    <div>
                        <h1 style="text-align: center;" > <?=__('no_data')?> </h1>
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
        <a href="#"><?__('about')?></a><a href="#"><?__('support')?></a><a href="#"><?__('term_of_service')?></a><a href="#"><?__('legal')?></a><a href="#"><?__('help')?></a><a href="#"><?__('contact_us')?></a>
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
    $(".btnReturn").on("click", function(e){
        var $this = $(this);
        $('#frRequestComment > #request_id').val($this.data("value"));
        $.ajax({
            type: "GET",
            url:   "/comment/get_comment.json",
            dataType: 'text',
            data:  'request_id='+$this.data("value"),
            success: function(data)
            {
                var returnedData = JSON.parse(data);
                $('.listComment').html(returnedData.content);
                console.log(data);

            }
        })
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
                console.log(data);
                var returnedData = JSON.parse(data);
                <?php if($userInfo->role[0]->name === 'top'){?>
                    if($this.data("mode") === 'app') {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
                    }else {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    }
                <?php }elseif($userInfo->role[0]->name === 'staff'){}else{ ?>
                    if($this.data("mode") === 'app') {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
                    }else {
                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
                    }
                <?php } ?>
                var btnAction = $this.parent();
                btnAction.empty();
                $("[class='tooltip fade top in']").remove();
                btnAction.html('<a href="/request/preview/'+returnedData.result.response.id+'" class="btn btn-primary" title="" data-toggle="tooltip" data-value="'+returnedData.result.response.id+'" data-mode="pre" data-original-title="Preview"><i class="icon-eye-off"></i></a>');

            }
        })
    });
    $(".requestAction").on("click", function(e){
        e.preventDefault();
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
