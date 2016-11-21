<?php
$status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=> (round( ( strtotime( $this->Time->i18nFormat($result['params']->appr_date,'MM/dd/yyyy') ) - time() ) / 86400 ) <= 1) ? 'highlight-out-pending' : 'highlight-pending'];
if($result['params']->role_name === 'top' || (int)$result['params']->top_status === 1 ||  ((int)$result['params']->department_id === 2 && $result['params']->role_name === 'manager')){
    $status = ['class'=>'label-success','value'=>'Approved','status' => false, 'rowclass'=>'highlight-success'];
}else{
    if((int)$result['params']->department_id === 2) {
        if ((int)$result['params']->manager_status === 1 && $userInfo->role[0]->name === 'manager') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false , 'rowclass'=>'highlight-success'];
        } elseif ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'top') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        }elseif ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'staff') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        }
        elseif ((int)$result['params']->manager_status === 2 || (int)$result['params']->top_status === 2) {
            $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=>'highlight-reject'];
        }
        else
            $status = ['class' => 'label-warning', 'value' => 'Pending', 'status' => true, 'rowclass'=>$status['rowclass']];
    }else{
        if ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'manager') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        } elseif ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'sub-manager') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        } elseif ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'top') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        }
        elseif ((int)$result['params']->top_status === 1 && $userInfo->role[0]->name === 'staff') {
            $status = ['class' => 'label-success', 'value' => 'Approved', 'status' => false, 'rowclass'=>'highlight-success'];
        }
        elseif ((int)$result['params']->manager_status === 2 || (int)$result['params']->top_status === 2 || (int)$result['params']->sub_manager_status === 2) {
            $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=>'highlight-reject'];
        }
        else

            $status = ['class' => 'label-warning', 'value' => 'Pending', 'status' => true, 'rowclass'=>$status['rowclass']];
    }
}
?>
<tr class="<?=$status['rowclass'];?>">
    <td></td>
    <td><strong><?= $result['params']->alias_name;?></strong></td>
    <td><strong><?php echo $result['params']->department_name;?></strong></td>
    <td><strong><?php echo $result['params']->categories_name;?></strong></td>
    <td><strong><?php echo $result['params']->title;?></strong></td>
    <td><strong><?= $this->Time->i18nFormat($result['params']->appr_date,'MM/dd/yyyy');?></strong></td>
    <td>
        <?php if((int)$result['params']->top_status === 1 || (int)$result['params']->top_status === 2){?>
            <strong  title="<?= ((int)$result['params']->top_status === 2 ? 'Reject by Top' : 'Approve by Top')?>"><i class="icon-adult"></i></strong>
        <?php } if((int)$result['params']->manager_status === 1 || (int)$result['params']->manager_status === 2){ ?>
            <strong  title="<?= ((int)$result['params']->manager_status === 2 ? 'Reject by Manager' : 'Approve by Manager')?>"><i class="icon-child"></i></strong>
        <?php } if((int)$result['params']->sub_manager_status === 1 || (int)$result['params']->sub_manager_status === 2){ ?>
            <strong  title="<?= ((int)$result['params']->sub_manager_status === 2 ? 'Reject by Sub-Manager' : 'Approve by Sub-Manager')?>"><i class="icon-child"></i></strong>
        <?php } ?>
    </td>
    <td> <span class="requestStatus label <?= $status['class'] ?>"><?= $status['value'] ?></span></td>
    <td><strong><?=  $this->Time->i18nFormat($result['params']->created,'MM/dd/yyyy');?></strong></td>
    <td>
        <div class="btn-group btn-group-xs">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cog"></i> <?=__('action')?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu primary" role="menu">
                <li class="requestAction" data-mode="multiApp"><a href="javascript:;"><?=__('approve')?></a></li>
                <li class="requestAction" data-mode="multiRej"><a href="javascript:;"><?=__('reject')?></a></li>
                <li class="requestAction" data-mode="multiDel">
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')) . ' '.__('preview'),'/requests/preview/'.$result['params']->id,array('data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id  ))?>
                    <a href="javascript:;"><?=__('preview')?></a></li>
                <li class="requestAction" data-mode="multiDel"><a href="javascript:;"><?=__('return')?></a></li>
                <li class="divider"></li>
            </ul>

            <?php if($userInfo->role[0]->name === 'admin' || $userInfo->role[0]->name === 'staff'){?>


            <?php }else{ ?>
                <?php if($status['status']){ ?>
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-ok-circled')),'javascript:;',array('class'=>'btn btn-success statusRequest','title'=>'Approve','data-toggle'=>"tooltip",'escape' => false ,'data-value'=>$result['params']->id,'data-mode' => 'app' ))?>
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-cancel-circled')),'javascript:;',array('class'=>'btn btn-danger statusRequest','title'=>'Reject','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id,'data-mode' => 'rej'  ))?>
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$result['params']->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id,'data-mode' => 'pre'  ))?>
                    <a class="btn btn-primary md-trigger btnReturn" title="" data-toggle="tooltip" data-value="<?=$result['params']->id;?>" data-mode="return" data-modal="md-add-request_comment" data-original-title="Return"><i class="fa fa-mail-forward"></i></a>
                <?php }else{ if(($userInfo->role[0]->name === 'manager' && (int)$result['params']->manager_status === 1) || ($userInfo->role[0]->name === 'sub-manager' && (int)$result['params']->sub_manager_status === 1)) ?>
                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')),'/requests/preview/'.$result['params']->id,array('class'=>'btn btn-primary','title'=>'Preview','data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id,'data-mode' => 'pre'  ))?>
                <?php } ?>
            <?php } ?>
        </div>
    </td>
</tr>