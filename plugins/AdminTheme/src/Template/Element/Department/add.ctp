<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="md-add-department">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3>Add<strong>Department</strong></h3>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->create($depart)?>
                    <div class="form-group">
                        <label for="lblUsername">Name</label>
                        <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="Enter department name">
                    </div>
                    <div class="form-group">
                        <label for="lblUsername">Tel</label>
                        <input type="text" class="form-control" id="dep_name" name="dep_tel" placeholder="Enter department tel">
                    </div>
                    <div class="form-group">
                        <label for="lblUsername">Address</label>
                        <input type="text" class="form-control" id="dep_address" name="dep_address" placeholder="Enter department address">
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- End .md-modal -->