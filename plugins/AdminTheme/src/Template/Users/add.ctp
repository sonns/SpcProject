<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget-header transparent">
            <h2>Add<strong>Users</strong> </h2>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
<!--                <form href="users/add" method="post">-->
                <?php echo $this->Form->create($user)?>
                    <div class="form-group">
                        <label for="lblUsername">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter user">
                    </div>
                    <div class="form-group">
                        <label for="lblEmail">Email address</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="lblPassword">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                    </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>