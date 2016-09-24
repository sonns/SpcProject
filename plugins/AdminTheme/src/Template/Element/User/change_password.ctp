<div class="tab-pane animated fadeInRight" id="reset_password">
    <div class="user-profile-content">
        <h4><strong>Reset </strong> Password</h4>
        <hr />
            <form role="form" method="post" id="resetPassword" name="resetPassword">
                <input type="hidden" value="resetpass" id="hdnmode" name="hdnmode">
                <div class="form-group">
                    <label for="txtPassword">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                    <label for="txtConfirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Enter New Confirm Password">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
    </div>
</div>