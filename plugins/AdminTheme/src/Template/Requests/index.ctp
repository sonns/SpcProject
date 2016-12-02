<!-- Modal add department-->
<?php echo $this->element('Request/edit') ?>
<?php echo $this->element('Request/comment') ?>
<?php echo $this->element('Request/change_status') ?>
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
                                        <li><a  data-modal="md-edit-request" class="md-trigger actionRequest" data-mode="add"   ><?=__('add_new')?></a></li>
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
                                if($request->role_name === 'top' || ((int)$request->department_id === 2 && $request->role_name === 'manager')){
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
                                    <?php } if($request->role_name === 'top' || ((int)$request->department_id === 2 && $request->role_name === 'manager')){?>
                                        <strong  title="<?= ((int)$request->role_name === 'top' ? 'Create by Top' : 'Create by Manager')?>"><i class="icon-child"></i></strong>
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
                                            <li>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')) . ' '.__('preview'),'/requests/preview/'.$request->id,array('data-toggle'=>"tooltip",'escape' => false,'data-value'=>$request->id  ))?>
                                            </li>

                                            <?php if($status['status'] && $userInfo->id !== $request->user_id ){ ?>
                                                <li>
                                                    <a class="md-trigger statusRequest" data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="app" data-status="<?=$status['status']; ?>" data-modal="md-add-request-status"><i class="icon-ok-circled"></i>  <?=__('approve')?></a>
                                                </li>
                                                <li>
                                                    <a class="md-trigger statusRequest" data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="rej"  data-status="<?=$status['status']; ?>" data-modal="md-add-request-status"><i class="icon-cancel-circled"></i>  <?=__('reject')?></a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a class="md-trigger btnReturn"  data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="return"  data-status="<?=$status['status']; ?>" data-modal="md-add-request-comment"><i class="fa fa-mail-forward"></i> <?=__('return')?></a>

                                            </li>
                                            <li>
                                                <a class="md-trigger actionRequest"  data-toggle="tooltip" data-value="<?=$request;?>" data-mode="edit"  data-modal="md-edit-request"><i class="fa fa-mail-forward"></i> <?=__('Edit Request')?></a>
                                            </li>
                                            <li class="divider"></li>
                                        </ul>

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
    $(".actionRequest").on("click", function(e){
        console.log(<?=$request?>);
        if($(this).data("mode") === 'add')
        {
            $('#frRequest1 > #request_id').val('');
        }else {
            bindingForm($(this).data("value"),'edit');
        }
    });
    $('#checkAll')
        .on('ifChecked', function(event) {
            $("input[name='request_id[]']").iCheck('check');
        })
        .on('ifUnchecked', function() {
            $("input[name='request_id[]']").iCheck('uncheck');
        });
    $(".btnReturn").on("click", function(e){
        var $this = $(this);
        $('.listComment').empty();
        $('#frRequestComment > #request_id').val($this.data("value"));
        if(parseInt($this.data("status"))){
            $('#frRequestComment').show();
        }else{
            $('#frRequestComment').hide();
        }
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
        $('#frChangeStatusRequest > #request_id').val($this.data("value"));
        $('#frChangeStatusRequest > #mod').val($this.data("mode"));

        $('#statusRequestAction').text('<?=__('approve')?>')
        if($this.data("mode") === 'app') {
            $('#statusRequestTitle').text('<?=__('approval_confirm')?>')
            $('.statusRequestContent').text('<?=__('approval_confirm_content')?>')
            $('#statusRequestAction').text('<?=__('approve')?>')
        }else if($this.data("mode") === 'rej') {
            $('#statusRequestTitle').text('<?=__('rejection_confirm')?>')
            $('.statusRequestContent').text('<?=__('rejection_confirm_content')?>')
            $('#statusRequestAction').text('<?=__('reject')?>')
        }
//        $.ajax({
//            type: "GET",
//            url:   "/request/change_status.json",
//            dataType: 'text',
//            data:  'request_id='+$this.data("value")+'&mod='+$this.data("mode"),
//            success: function(data)
//            {
//                console.log(data);
//                var returnedData = JSON.parse(data);
//                <?php //if($userInfo->role[0]->name === 'top'){?>
//                    if($this.data("mode") === 'app') {
//                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
//                    }else {
//                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
//                    }
//                <?php //}elseif($userInfo->role[0]->name === 'staff'){}else{ ?>
//                    if($this.data("mode") === 'app') {
//                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-success').text('Approved');
//                    }else {
//                        $this.parents(':eq(2)').find('.requestStatus').removeClass('label-danger').removeClass('label-warning').addClass('label-danger').text('Rejected');
//                    }
//                <?php //} ?>
//                var btnAction = $this.parent();
//                btnAction.empty();
//                $("[class='tooltip fade top in']").remove();
//                btnAction.html('<a href="/request/preview/'+returnedData.result.response.id+'" class="btn btn-primary" title="" data-toggle="tooltip" data-value="'+returnedData.result.response.id+'" data-mode="pre" data-original-title="Preview"><i class="icon-eye-off"></i></a>');
//
//            }
//        })
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
    function bindingForm(param,mod){
        console.log(param);
    }
</script>
