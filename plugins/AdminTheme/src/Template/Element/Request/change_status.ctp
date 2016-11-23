<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-request-status" >
    <div class="md-content" style="max-width: 400px;" >
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><strong id="statusRequestTitle"></strong></h3>
        <div class="widget">
            <!-- Begin timeline -->
            <p class="statusRequestContent text-center"></p>
            <div>
                <form class="form-horizontal" role="form" id="frChangeStatusRequest" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control" style="height: 70px;" id="txtComment" name="txtComment" placeholder="<?=__('confirm_comment')?>..."></textarea>
                    </div>
                    <input type="hidden" name="request_id" id="request_id" value="">
                    <input type="hidden" name="mod"  id="mod" value="">
                    <div class="row">
                        <div class="form-group col-sm-12 text-center">
                                <button type="submit" class="btn btn-success" id="statusRequestAction"><?=__('submit')?></button>
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
