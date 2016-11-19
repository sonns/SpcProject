<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget-header transparent">
            <h2><strong><?=__('edit')?></strong> <?=__('user')?></h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?=__('email')?></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="<?=__('placeholder_email')?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><?=__('pass')?></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="<?=__('*******')?>">
                    </div>
                    <div class="form-group">
                        <input type="file" class="btn btn-default" title="Search for a file to add">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>