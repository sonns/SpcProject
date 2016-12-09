<!-- Tab about -->
<div class="tab-pane animated active fadeInRight" id="about">
    <div class="user-profile-content">
        <h4><strong><?=__("info_title")?></strong></h4>
        <hr />
        <div class="row">

            <form role="form" id="editProfile" method="post" name="editProfile"  enctype="multipart/form-data" >
                <input type="hidden" value="profile" id="hdnmode" name="hdnmode">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblFirstName"><b><?= __('first_name')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['first_name'] : '' ?>" class="form-control" id="first_name" name="first_name" placeholder="<?= __('placeholder_first_name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblAltContactEmail"><b><?= __('last_name')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['last_name'] : '' ?>" class="form-control" id="last_name" name="last_name" placeholder="<?= __('placeholder_last_name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblPhoneNumber"><b><?= __('phone_number')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['contact_number'] : '' ?>" class="form-control" id="phone_num" name="phone_num" placeholder="<?= __('placeholder_phone')?>">
                    </div>

                    <div class="form-group">
                        <label for="lblAddress"><b><?= __('address')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['address'] : '' ?>" class="form-control" id="address" name="address" placeholder="<?= __('placeholder_address')?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblContactNum"><b><?= __('timezone')?></b></label>
                        <select class="form-control" name="timezone">
                            <option value="">-- <?= __('placeholder_select_timezone')?> --</option>
                            <?php
                            foreach($timezone as $key=>$value){
                                $selected = '';
                                if(isset($userInfo['profile']) && $key == $userInfo['profile']['timezone']){
                                    $selected = 'selected';
                                }
                                echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="imgProfile" id="imgProfile" class="btn btn-default" title="<?=__('select_profile_photo')?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= __('birthday')?></label>
                        <input type="text" name="birthday" value="<?= isset($userInfo['profile']) ? $this->Time->i18nFormat($userInfo['profile']['birthday'],'yyyy/MM/dd')  : '' ?>" id="birthday" class="form-control datepicker-input"  placeholder="<?= __('yyyy/mm/dd')?>">
                    </div>
                    <button type="submit" class="btn btn-success"><?= __('submit')?></button>
                </div>
            </form>
        </div><!-- End div .row -->
    </div><!-- End div .user-profile-content -->
</div><!-- End div .tab-pane -->
<!-- End Tab about -->
<div class="md-overlay"></div>
<?= $this->Html->script('AdminTheme./assets/libs/jquery/jquery-1.11.1.min.js') ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-validator/js/bootstrapValidator.js') ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/master-validation.js') ?>