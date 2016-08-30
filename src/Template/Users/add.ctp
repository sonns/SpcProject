<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget-header transparent">
            <h2>Add<strong>Users</strong> </h2>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <?php echo $this->Form->create(null,['url'=>['controller' => 'users','action'=>'add','add_user']])?>
                    <div class="form-group">
                        <label for="lblUsername">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter user">
                    </div>
                    <div class="form-group">
                        <label for="lblEmail">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="lblPassword">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="*******">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>