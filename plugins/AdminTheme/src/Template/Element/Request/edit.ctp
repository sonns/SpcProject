<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-edit-request" >
    <div class="md-content" style="height: 600px !important;overflow-y: scroll;">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><strong id="titleRequestForm"></strong></h3>
        <div class="widget">
            <div class="widget-content padding">
                <form class="form-horizontal" role="form" id="frRequest1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <?php echo  $this->Form->select(
                                'sltCategory',
                                $listCate,
                                [
                                    'empty' => __('slt_cate'),
                                    'class' => 'form-control',
                                    'name'=> 'sltCategory',
                                    'id'=> 'sltCategory'

                                ]
                            );?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?=__('price')?></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="txtPrice" id="txtPrice" class="form-control">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="request_id" id="request_id" value="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?=__('appr_date')?></label>
                        <div class="col-sm-9">
                            <input type="text" id="txtApproveDate" name="txtApproveDate"
                                   class="form-control datepicker-input" data-mask="99-99-9999" placeholder="<?=__('placeholder_format_date')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?=__('payment_date')?></label>
                        <div class="col-sm-9">
                            <input type="text" id="txtPaymentDate" name="txtPaymentDate"
                                   class="form-control datepicker-input" data-mask="99-99-9999" placeholder="<?=__('placeholder_format_date')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="lblTitle"><?=__('title')?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="<?=__('placeholder_title')?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblDescription"><?=__('description')?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtDescription" name="txtDescription" placeholder="<?=__('placeholder_des')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblReason"><?=__('reason')?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtReason" name="txtReason" placeholder="<?=__('placeholder_reason')?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"  for="lblNote"><?=__('note')?></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtNote" name="txtNote" placeholder="<?=__('placeholder_note')?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <input type="file" class="btn btn-default" name="fileAttach" title="<?=__('attach_file')?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                            <button type="reset" class="btn btn-default"><?=__('cancel')?></button>
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
