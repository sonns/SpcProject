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
        <?php } if($result['params']->role_name === 'top' || ((int)$result['params']->department_id === 2 && $result['params']->role_name === 'manager')){?>
            <strong  title="<?= ((int)$result['params']->role_name === 'top' ? 'Create by Top' : 'Create by Manager')?>"><i class="icon-child"></i></strong>
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
                <li>
                    <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')) . ' '.__('preview'),'/requests/preview/'.$result['params']->id,array('data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id  ))?>
                </li>

                <?php if($status['status']){ ?>
                    <li>
                        <a class="md-trigger statusRequest" data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="app" data-modal="md-add-request-status"><i class="icon-ok-circled"></i>  <?=__('approve')?></a>
                    </li>
                    <li>
                        <a class="md-trigger statusRequest" data-toggle="tooltip" data-value="<?=$request->id;?>" data-mode="rej" data-modal="md-add-request-status"><i class="icon-cancel-circled"></i>  <?=__('reject')?></a>
                    </li>
                    <li>
                        <a class="md-trigger btnReturn"  data-toggle="tooltip" data-value="<?=$result['params']->id;?>" data-mode="return" data-modal="md-add-request_comment"><i class="fa fa-mail-forward"></i> <?=__('return')?></a>
                    </li>
                <?php } ?>
                <li class="divider"></li>
            </ul>
        </div>
    </td>
</tr>