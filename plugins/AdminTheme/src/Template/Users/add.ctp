<!-- Your awesome content goes here -->
<div class="md-content">
    <h3><?=__('add')?> <strong><?=__('user')?></strong></h3>
    <div class="widget">

<div class="row">
    <div class="col-sm-8 portlets">
        <div class="alertMessage">
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form method="post" id="createUser">
                <div class="form-group">
                    <label for="lblEmail"><?=__('email')?></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="<?=__('placeholder_email')?>" >
                </div>
                <div class="form-group">
                    <label for="lblUsername"><?=__('username')?></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="<?=__('placeholder_username')?>">
                </div>
                <div class="form-group">
                    <?php  echo $this->Form->input(
                        'role_id',
                        array(
                            'options' => $listRoles ,
                            'class' => 'form-control',
                            'name' => 'role_id',
                            'id' => 'role_id',
                            'empty' => 'Select Role'
                        )
                    );?>
                </div>
                <div class="form-group">
                    <?php  echo $this->Form->input(
                        'Department_id',
                        array('options' => $listDepartments ,
                            'class' => 'form-control',
                            'name' => 'dep_id',
                            'id' => 'dep_id',
                            'empty' => 'Select Department'
                        )

                    );?>
                </div>
                <div class="form-group">
                    <label for="lblPassword"><?=__('pass')?></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label for="lblPassword"><?=__('confirm_pass')?></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="*******">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success"><?=__('submit')?></button>
                    <button type="reset" class="btn btn-default"><?=__('cancel')?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>