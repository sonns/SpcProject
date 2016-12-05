<div class="full-content-center">
    <p class="text-center"><a href="#">
            <?php echo $this->Html->image('AdminTheme./assets/img/spc-logo-transparent.png', ['alt' => 'SPC COMPANY','width'=>'150']);?>
           </a></p>
    <div class="login-wrap animated flipInX">
        <div class="login-block">
            <?php echo $this->Html->image('AdminTheme./assets/img/avata.png', ['alt' => 'avata','class'=>'img-circle not-logged-avatar']);?>

            <?php echo $this->Form->create(null,['url'=>['controller' => 'AuthMaster','action'=>'login','login']])?>
                <div class="form-group login-input">
                    <i class="fa fa-user overlay"></i>
                    <input type="text" class="form-control text-input" placeholder="<?= __("placeholder_email_username")?>" name="username" id="username">
                </div>
                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    <input type="password" id="login_pass" name="password" class="form-control text-input" placeholder="********">
                </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember_me" id="remember_me"><?= __("remember")?>
                </label>
            </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-block"><?= __("login")?></button>
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-default btn-block"><?= __("forgot_password")?> </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>