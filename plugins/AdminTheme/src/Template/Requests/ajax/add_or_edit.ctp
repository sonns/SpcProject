<?php
if($result['action'] === 'edit'){

}else{
    $result['params']->appr_date = $this->Time->i18nFormat($result['params']->appr_date,'yyyy/MM/dd');
    $result['params']->payment_date = $this->Time->i18nFormat($result['params']->payment_date,'yyyy/MM/dd');
    $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=> (round( ( strtotime( $result['params']->appr_date) - time() ) / 86400 ) <= 1) ? 'highlight-out-pending' : 'highlight-pending'];
    if($result['params']->role_name === 'top' || ((int)$result['params']->department_id === 1 && $result['params']->role_name === 'manager') || $result['params']->status === 'approved'){
        $status = ['class'=>'label-success','value'=>'Approved','status' => false, 'rowclass'=>'highlight-success'];
    }elseif ($result['params']->status === 'rejected'){
        $status = ['class'=>'label-danger','value'=>'Rejected','status' => false, 'rowclass'=>'highlight-reject'];
    }elseif ($result['params']->status === 'returned'){
        $status = ['class'=>'label-success','value'=>'Returned','status' => false, 'rowclass'=>'highlight-return'];
    }
    else{
        $status = ['class' => 'label-warning', 'value' => 'Pending', 'status' => true, 'rowclass'=>$status['rowclass']];
    }
    ?>
    <tr class="<?=$status['rowclass'];?>">
        <td></td>
        <td><strong><?= $result['params']->alias_name;?></strong></td>
        <td><strong><?php echo $result['params']->department_name;?></strong></td>
        <td><strong><?php echo $result['params']->categories_name;?></strong></td>
        <td><strong><?php echo $result['params']->title;?></strong></td>
        <td><strong><?= $result['params']->appr_date;?></strong></td>
        <td>
            <?php if((int)$result['params']->top_status === 1 || (int)$result['params']->top_status === 2 || $result['params']->role_name === 'top' ){?>
                <strong  title="<?= ($result['params']->role_name === 'top' ? __('created_by_top') : ( (int)$result['params']->top_status === 2 ? __('rejected_by_top') : __('approved_by_top')))?>"><i class="icon-person"></i></strong>
            <?php } if((int)$result['params']->manager_status === 1 || (int)$result['params']->manager_status === 2 ||  $result['params']->role_name === 'manager'){ ?>
                <strong  title="<?= ($result['params']->role_name === 'manager' ? __('created_by_manager') : ( (int)$result['params']->manager_status === 2 ? __('rejected_by_manager') : __('rejected_by_manager'))) ?>"><i class="icon-adult"></i></strong>
            <?php } if((int)$result['params']->sub_manager_status === 1 || (int)$result['params']->sub_manager_status === 2 ||  $result['params']->role_name === 'sub-manager'){ ?>
                <strong  title="<?= ($result['params']->role_name === 'sub-manager' ? __('created_by_sub') : ( (int)$result['params']->sub_manager_status === 2 ? __('rejected_by_sub') : __('rejected_by_sub'))) ?>"><i class="icon-child"></i></strong>
            <?php } if($result['params']->role_name === 'staff'){?>
                <strong  title="<?= __('created_by_staff')?>"><i class="icon-user-1"></i></strong>
            <?php } ?>
        </td>
        <td> <span class="requestStatus label <?= $status['class'] ?>"><?= $status['value'] ?></span></td>
        <td><strong><?=  $this->Time->i18nFormat($result['params']->created,'yyyy/MM/dd');?></strong></td>
        <td>
            <div class="btn-group btn-group-xs">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i> <?=__('action')?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu primary" role="menu">
                    <?php if($result['params']->status === 'waiting'){ ?>
                        <li>
                            <a class="md-trigger statusRequest"  data-toggle="tooltip" data-value="<?=$result['params']->id;?>" data-mode="history"  data-status="<?=$result['params']->status; ?>" data-modal="md-add-request-comment"><i class="fa fa-mail-forward"></i> <?=__('history')?></a>
                        </li>
                    <?php } ?>
                    <li>
                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'icon-eye-off')) . ' '.__('preview'),'/requests/preview/'.$result['params']->id,array('data-toggle'=>"tooltip",'escape' => false,'data-value'=>$result['params']->id  ))?>
                    </li>
                    <li class="divider"></li>
                </ul>
            </div>
        </td>
    </tr>
<?php } ?>