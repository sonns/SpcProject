<!-- Modal add department-->
<?php echo $this->element('User/add') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> <?=__('user').' '.__('list')?></h1>
</div>
    <!-- Page Heading End-->
    <!-- Your awesome content goes here -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <div class="additional-btn">
                        <a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'add'])?>" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <?php if($userInfo->role[0]->name === 'admin'){?>
                            <a href="<?php echo $this->Url->build(['controller'=>'users','action'=>'delete','del_user'])?>" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <?php } ?>
                    </div>
                </div>
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
                                    <a data-modal="md-add-user" class="btn btn-success md-trigger"><i class="fa fa-plus-circle"></i><?=__('add_new')?></a>
                                    <a data-modal="md-add-user" class="btn btn-danger md-trigger"><i class="fa fa-trash-o"></i><?=__('del')?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th><?=__('stt')?></th>
                                <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
                                <th><?=__('name')?></th>
                                <th><?=__('email')?></th>
                                <th><?=__('username')?></th>
                                <th><?=__('confirm')?></th>
                                <th><?=__('create_date')?></th>
                                <th data-sortable="false"><?=__('action')?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?php echo $key+1;?></td><td><input type="checkbox" class="rows-check"></td>
                                    <td><strong><?= (!isset($user->profile->first_name)) ? 'N/A' : $user->profile->first_name.' '. $user->profile->last_name ;?></strong></td>
                                    <td><strong><?php echo $user->email;?></strong></td>
                                    <td><strong><?php echo $user->username;?></strong></td>
                                    <td> <span class="label <?php echo ($user->confirmed) ? 'label-success' :'label-danger' ?>"><?php echo ($user->confirmed) ? __('active') :__('suspend') ?></span></td>
                                    <td><strong><?php echo $user->created;?></strong></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            <?php if($userInfo->role[0]->name !== 'admin'){?>
                                                <span class="requestStatus label label-danger"><?= __('no_permission')?></span>
                                            <?php }else{ ?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-edit')),array('controller'=>'users','action'=>'edit','edit_dep'),array('style' => 'margin-right:4px;' ,'class'=>'btn btn-default','title'=>__('edit'),'data-toggle'=>"tooltip",'escape' => false ))?>
                                                <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-remove')),array('controller'=>'users','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>__('del'),'data-toggle'=>"tooltip",'escape' => false ))?>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <footer>
        Son Nguyen &copy; 2014
        <div class="footer-links pull-right">
            <a href="#"><?__('about')?></a><a href="#"><?__('support')?></a><a href="#"><?__('term_of_service')?></a><a href="#"><?__('legal')?></a><a href="#"><?__('help')?></a><a href="#"><?__('contact_us')?></a>
        </div>
    </footer>