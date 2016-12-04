<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal">
    <div class="md-content">
        <h3><strong><?=__('logout_confirm')?></strong></h3>
        <div>
            <p class="text-center"><?=__('logout_content')?></p>
            <p class="text-center">
                <a href="<?php echo $this->Url->build([
                    "controller" => "AuthMaster",
                    "action" => "logout",
                    "logout"
                ])?>" class="btn btn-success"><?=__('submit')?></a>
                <a class="btn btn-danger md-close"><?=__('cancel')?></a>
            </p>
        </div>
    </div>
</div>        <!-- Modal End -->