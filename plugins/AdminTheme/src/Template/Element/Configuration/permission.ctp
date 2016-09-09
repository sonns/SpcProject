<div class="tab-pane animated fadeInRight" id="permissions">
    <div class="row">
        <h4><strong> Manage </strong> Permission</h4>
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header   " >
                    <h2 style="color: white"><strong>Roles</strong> Table</h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table data-sortable class="table">
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
                                <tr>
                                <td style="padding: 20px;"><?php echo $acls['alias'];?></td>
                                <?php foreach ($roles as $key1 => $role): ?>
                                    <td>
                                        <label class="icheckbox">
                                            <input type="checkbox" id="inlineCheckbox1" value="<?php echo $acls['controller'].$role->name;?>">
                                        </label>
                                    </td>
                                <?php endforeach;?>
                                </tr>
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
