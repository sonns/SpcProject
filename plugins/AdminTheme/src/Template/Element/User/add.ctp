<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-user">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><?=__('add')?> <strong><?=__('user')?></strong></h3>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->create($userE,['url'=>['controller'=>'department','action'=>'add'],'id'=>'createDepartment'])?>
                    <div class="form-group">
                        <label for="lblUsername"><?=__('name')?></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="<?=__('placeholder_name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblTel"><?=__('username')?></label>
                        <input type="text" class="form-control" id="tel" name="dep_tel" placeholder="<?=__('placeholder_username')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblAddress"><?=__("pass")?></label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="*****">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                        <button type="reset" class="btn btn-default"><?=__('cancel')?></button>
                    </div>
                    <div id="message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- End .md-modal -->
<div class="md-overlay"></div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>