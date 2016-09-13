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
                    <input type="text" class="form-control text-input" placeholder="Enter your email or username" name="username" id="username">
                </div>
                <div class="form-group login-input">
                    <i class="fa fa-key overlay"></i>
                    <input type="password" id="login_pass" name="password" class="form-control text-input" placeholder="********">
                </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-block">LOGIN</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="#" class="btn btn-default btn-block">Forgot password</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>