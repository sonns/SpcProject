<div class="row">
    <div class="col-md-12 portlets">
        <div class="card-panel">
            <?= $this->Form->create() ?>
            <div class="row">
                <div class="col-md-12 portlets">
                    <?= $this->Form->input( "message", [ "label" => "Mensaje", "class" => "validate"] ) ?>
                </div>
            </div>
            <?= $this->Form->button('<i class="material-icons">send</i>', ["type"=>"submit", "class"=>"btn waves-effect waves-light  indigo darken-4", "escape"=>false]) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>