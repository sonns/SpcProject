<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-department">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3>Add <strong>Request Form</strong></h3>
        <div class="widget">
            <div class="widget-content padding">
                <form class="form-horizontal" role="form" id="frRequest">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <?php echo  $this->Form->select(
                                    'sltCategory',
                                    $listCate,
                                    ['empty' => 'Select Category']
                                );?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Price(+VAT)</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input type="file" class="btn btn-default" name="fileAttach" title="Attach file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="lblUsername">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="Enter department name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="lblAddress">Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="Enter department address">
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblAddress">Reason</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="Enter department address">
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"  for="lblAddress">Note</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="Enter department address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Approve Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker-input" data-mask="99-99-9999" placeholder="mm-dd-yyyy">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                        <div id="message"></div>
                    </form>
                </div>
        </div>
    </div>
</div><!-- End .md-modal -->
<div class="md-overlay"></div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>