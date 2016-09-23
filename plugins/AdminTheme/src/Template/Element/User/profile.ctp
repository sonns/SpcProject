<!-- Tab about -->
<div class="tab-pane animated active fadeInRight" id="about">
    <div class="user-profile-content">
        <h4><strong>Basic </strong> Information</h4>
        <hr />
        <div class="row">

            <form role="form" id="editProfile" method="post" name="editProfile"  enctype="multipart/form-data" >
                <input type="hidden" value="profile" id="hdnmode" name="hdnmode">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblFirstName"><b><?= __('First Name')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['first_name'] : '' ?>" class="form-control" id="first_name" name="first_name" placeholder="<?= __('Enter Your First Name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblAltContactEmail"><b><?= __('Last Name')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['last_name'] : '' ?>" class="form-control" id="last_name" name="last_name" placeholder="<?= __('Enter Your Last Name')?>">
                    </div>
                    <div class="form-group">
                        <label for="lblPhoneNumber"><b><?= __('Phone Number')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['contact_number'] : '' ?>" class="form-control" id="phone_num" name="phone_num" placeholder="<?= __('Enter Your Phone Number')?>">
                    </div>

                    <div class="form-group">
                        <label for="lblAddress"><b><?= __('Address')?></b></label>
                        <input type="text" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['address'] : '' ?>" class="form-control" id="address" name="address" placeholder="<?= __('Enter Your Address')?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblContactNum"><b><?= __('Timezone')?></b></label>
                        <select class="form-control" name="timezone">
                            <option value="">-- <?= __('Select a timezone')?> --</option>
                            <?php
                            foreach($timezone as $key=>$value){
                                $selected = '';
                                if(isset($userInfo['profile']) || $key == $userInfo['profile']['timezone']){
                                    $selected = 'selected';
                                }
                                echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="imgProfile" id="imgProfile" class="btn btn-default" title="Select Profile Photo">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= __('Your Birthday')?></label>
                        <input type="text" name="birthday" value="<?= isset($userInfo['profile']) ? $userInfo['profile']['birthday'] : '' ?>" id="birthday" class="form-control datepicker-input"  placeholder="<?= __('mm/dd/yyyy')?>">
                    </div>
                    <button type="submit" class="btn btn-success"><?= __('Submit')?></button>
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