<!-- Tab about -->
<div class="tab-pane animated active fadeInRight" id="about">
    <div class="user-profile-content">
        <h4><strong>Basic </strong> Information</h4>
        <hr />
        <div class="row">

            <form role="form" id="editProfile" method="post" enctype="multipart/form-data" >
                <input type="hidden" value="profile" id="hdnmode" name="hdnmode">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblContactNum"><b>Contact Number</b></label>
                        <input type="text" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Contact Number">
                    </div>
                    <div class="form-group">
                        <label for="lblAltContactNum"><b>Alternate Contact Number</b></label>
                        <input type="text" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Alternate Contact Number">
                    </div>
                    <div class="form-group">
                        <label for="lblAltContactEmail"><b>Alternate Email</b></label>
                        <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Enter Alternate Email">
                    </div>
                    <div class="form-group">
                        <label for="lblAddress"><b>Address</b></label>
                        <input type="text" class="form-control" id="contact_address" name="contact_address" placeholder="Enter Your Address">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lblContactNum"><b>Timezone</b></label>
                        <select class="form-control" name="timezone">
                            <option value="">-- Select a timezone --</option>
                            <?php
                            foreach($timezone as $key=>$value){
                                $selected = '';

                                if($key == $this->Session->read('Auth.User.timezone')){
                                    $selected = 'selected';
                                }
                                echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" class="btn btn-default" title="Select Profile Photo">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Your Birthday</label>
                        <input type="text" class="form-control datepicker-input">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div><!-- End div .row -->
    </div><!-- End div .user-profile-content -->
</div><!-- End div .tab-pane -->
<!-- End Tab about -->