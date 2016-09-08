<div class="col-sm-4 ">
    <h4><strong> Roles </strong></h4>
    <hr />
    <div class="row">
        <form role="form" method="post" id="addRole" name="addRole">
            <input type="hidden" value="resetpass" id="hdnmode" name="hdnmode">
            <div class="form-group">
                <label for="tblName"><?php echo __('Name');?></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="tblDisplayName"><?php echo __('Display Name');?></label>
                    <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Enter Display Name">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
<div class="col-sm-8">
    <div class="table-responsive">
        <table data-sortable class="table table-hover table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
                <th>Name</th>
                <th>Display Name</th>
                <th data-sortable="false">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($roles as $key => $role): ?>
                <tr>
                    <td><?php echo $key+1;?></td><td><input type="checkbox" class="rows-check"></td>
                    <td><strong><?php echo $role->name;?></strong></td>
                    <td><strong><?php echo $role->display_name;?></strong></td>
                    <td>
                        <div class="btn-group btn-group-xs">
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-edit')),array('controller'=>'users','action'=>'edit','edit_dep'),array('style' => 'margin-right:4px;' ,'class'=>'btn btn-default','title'=>'Edit','data-toggle'=>"tooltip",'escape' => false ))?>
                            <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-remove')),array('controller'=>'users','action'=>'delete','del_dep'),array('class'=>'btn btn-danger','title'=>'Delete','data-toggle'=>"tooltip",'escape' => false ))?>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>