<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget-header transparent">
            <h2><?=__("Update")?> <strong><?=__("department")?></strong> </h2>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <?php echo $this->Form->create($department)?>
                <div class="form-group">
                    <label for="lblUsername"><?=__('name')?></label>
                    <input type="text" value="<?= $department->name ;?>" class="form-control" id="dep_name" name="dep_name" placeholder="<?=__("placeholder_department_name")?>">
                </div>
                <div class="form-group">
                    <label for="lblUsername"><?=__('tel')?></label>
                    <input type="text"  value="<?= $department->tel ;?>" class="form-control" id="dep_tel" name="dep_tel" placeholder="<?=__("placeholder_department_tel")?>">
                </div>
                <div class="form-group">
                    <label for="lblUsername"><?=__('address')?></label>
                    <input type="text"  value="<?= $department->address ;?>" class="form-control" id="dep_address" name="dep_address" placeholder="<?=__("placeholder_department_address")?>">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                    <button type="reset" class="btn btn-default"><?=__('cancel')?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>