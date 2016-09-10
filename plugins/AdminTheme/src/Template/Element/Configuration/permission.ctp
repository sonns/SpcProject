<div class="tab-pane animated fadeInRight" id="permissions">
    <div class="row"  style="padding-left:25px;">
        <h4><strong> Manage </strong> Permission</h4>
        <div class="col-sm-11 center">
            <div class="widget">
                <div class="widget-content">
                    <div class="table-responsive">
                        <table  class="table">
                            <thead>
                            <tr >
                                <th>Permission
                                <?php foreach ($roles as $key => $role): ?>
                                    <th><?php echo $role->display_name;?></th>
                                <?php endforeach;?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($listAcl as $key => $acls): ?>
                                <tr class="btn-success">
                                    <td><?php echo $acls['alias'];?></td>
                                    <?php foreach ($roles as $key1 => $role): ?>
                                        <td><td>
                                    <?php endforeach;?>
                                </tr>

                                    <?php foreach ($acls['roles'] as $key1 => $acl): ?>
                                    <tr>
                                        <td style="padding: 20px;"><?php echo $acl;?></td>
                                        <?php foreach ($roles as $key2 => $role): ?>
                                            <td>
                                                <label class="icheckbox">
                                                    <input type="checkbox" <?php
                                                    //$key! = action
                                                    if(isset($acls['actions']['*']) or isset($acls['actions'][$key1]))
                                                    {
                                                        if(in_array($role->id,$acls['actions']['*'])){
                                                            echo 'checked';
                                                        }elseif(isset($acls['actions'][$key1]) and in_array($role->id, $acls['actions'][$key1])){
                                                            echo 'checked';
                                                        }
                                                        else
                                                            echo '';
                                                    }else{
                                                        echo 'checked';
                                                    }

                                                    ?> id="inlineCheckbox1" value="<?php echo $acls['controller'].'_'.$key1;?>">
                                                </label>
                                            </td>
                                        <?php endforeach;?>
                                    </tr>
                                    <?php endforeach;?>


                                <tr>


                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
