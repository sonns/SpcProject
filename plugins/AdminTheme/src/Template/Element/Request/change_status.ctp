<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-request_status" >
    <div class="md-content" style="height: 600px !important;overflow-y: scroll;">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><strong><?=__('activities').' '. __('list') ?></strong></h3>
        <div class="widget">
            <!-- Begin timeline -->
            <div class="the-timeline" >
                <form class="form-horizontal" role="form" id="frRequestComment" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control" style="height: 70px;" id="txtComment" name="txtComment" placeholder="<?=__('placeholder_yr_cmt')?>..."></textarea>
                    </div>
                    <input type="hidden" name="request_id" id="request_id" value="">
                    <input type="hidden" name="mod"  id="mod" value="return">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="form-group col-sm-6 text-right">
                                <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                                <button type="reset" class="btn btn-default"><?=__('cancel')?></button>
                        </div>
                    </div>
                </form>
                <br><br>
            </div><!-- End div .the-timeline -->
            <!-- End timeline -->
        </div>
    </div>
</div><!-- End .md-modal -->
<div class="md-overlay"></div>
