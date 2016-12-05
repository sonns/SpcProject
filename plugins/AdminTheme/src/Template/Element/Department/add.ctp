<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-department">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3 id="titleDepartment"><strong><?=__('add_department')?></strong></h3>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->create($depart,['url'=>['controller'=>'department','action'=>'add'],'id'=>'createDepartment'])?>
                    <div class="form-group">
                        <label for="lblUsername"><?=__('dep_name')?></label>
                        <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="<?=__('placeholder_department_name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblTel"><?=__('tel')?></label>
                        <input type="text" class="form-control" id="dep_tel" name="dep_tel" placeholder="<?=__('placeholder_department_tel')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblAddress"><?=__('address')?></label>
                        <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="<?=__('placeholder_department_address')?>">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <div class="radio-inline iradio">
                                <label>
                                    <input type="radio" name="status" id="status1" value="1">
                                    <?= __('active'); ?>
                                </label>
                            </div>
                            <div class="radio-inline iradio">
                                <label>
                                    <input type="radio" name="status" id="status2" value="0" checked>
                                    <?= __('deactivate'); ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                        <button type="reset" id="btnResetDepartment" class="btn btn-default"><?=__('cancel')?></button>
                    </div>
                    <div id="message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- End .md-modal -->

<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>