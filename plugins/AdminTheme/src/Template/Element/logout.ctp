<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal">
    <div class="md-content">
        <h3><strong><?=__('logout_confirm')?></strong></h3>
        <div>
            <p class="text-center"><?=__('logout_content')?></p>
            <p class="text-center">
                <button class="btn btn-danger md-close"><?=__('cancel')?></button>
                <a href="<?php echo $this->Url->build([
                    "controller" => "AuthMaster",
                    "action" => "logout",
                    "logout"
                ])?>" class="btn btn-success md-close"><?=__('submit')?></a>
            </p>
        </div>
    </div>
</div>        <!-- Modal End -->