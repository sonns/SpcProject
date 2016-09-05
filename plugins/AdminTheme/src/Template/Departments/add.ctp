<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget-header transparent">
            <h2>Add<strong>Users</strong> </h2>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
<!--                <form href="users/add" method="post">-->
                <?php echo $this->Form->create($department,['id'=>'createDepartment'])?>
                    <div class="form-group">
                        <label for="lblUsername">Name</label>
                        <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="Enter department name">
                    </div>
                    <div class="form-group">
                        <label for="lblTel">Tel</label>
                        <input type="text" class="form-control" id="dep_tel" name="dep_tel" placeholder="Enter department tel">
                    </div>
                <div class="form-group">
                    <label for="lblAddress">Address</label>
                    <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="Enter department address">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>