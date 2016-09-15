<!-- Modal End -->
<div id="md-add-department" >
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3>Add <strong>Request Form</strong></h3>
        <div class="widget">
            <div class="widget-content padding">
                <form href="request/add" method="post" class="form-horizontal" role="form" id="frRequest" enctype="multipart/form-data">
                    <input type="hidden" name="user_id">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <?php echo  $this->Form->select(
                                'sltCategory',
                                $listCate,
                                [
                                    'empty' => 'Select Category',
                                    'class' => 'form-control',
                                    'name'=> 'sltCategory',
                                    'id'=> 'sltCategory'

                                ]
                            );?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Price(+VAT)</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="txtPrice" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Approve Date</label>
                        <div class="col-sm-9">
                            <input type="text" id="txtApproveDate" name="txtApproveDate"
                                   class="form-control datepicker-input" data-mask="99-99-9999" placeholder="mm-dd-yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="lblTitle">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="Enter department name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblDescription">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder="Enter department address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblReason">Reason</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtReason" name="txtReason" placeholder="Enter department address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblNote">Note</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtNote" name="txtNote" placeholder="Enter department address">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input type="file" class="btn btn-default" name="fileAttach" title="Attach file">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"></div>
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
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>
