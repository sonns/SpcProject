<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-department">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3>Add <strong>Department</strong></h3>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->create($depart,['url'=>['controller'=>'department','action'=>'add'],'id'=>'createDepartment'])?>
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
                    <div class="form-group">
                        <div class="col-sm-10">
                            <div class="radio-inline iradio">
                                <label>
                                    <input type="radio" name="status" id="status1" value="1">
                                    <?= __('Active'); ?>
                                </label>
                            </div>
                            <div class="radio-inline iradio">
                                <label>
                                    <input type="radio" name="status" id="status2" value="0" checked>
                                    <?= __('Deactivate'); ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
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