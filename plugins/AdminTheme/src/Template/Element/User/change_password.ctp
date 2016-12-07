<div class="tab-pane animated fadeInRight" id="reset_password">
    <div class="user-profile-content">
        <h4><strong><?=__('reset_pass')?> </strong></h4>
        <hr />
            <form role="form" method="post" id="resetPassword" name="resetPassword">
                <input type="hidden" value="resetpass" id="hdnmode" name="hdnmode">
                <div class="form-group">
                    <label for="txtPassword"><?=__("pass")?></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="<?=__('placeholder_new_pass')?>">
                </div>
                <div class="form-group">
                    <label for="txtConfirmPassword"><?=__('confirm_pass')?></label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="<?=__('placeholder_new_confirm_pass')?>">
                </div>
                <button type="submit" class="btn btn-success"><?=__('submit')?></button>
            </form>
    </div>
</div>