<!-- Modal add department-->
<?php echo $this->element('Department/add') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> Department List</h1>
</div>
<!-- Page Heading End-->
<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-content">
                <div class="data-table-toolbar">
                    <div class="row">
                        <div class="col-md-4">
                            <form role="form">
                                <input type="text" class="form-control" placeholder="Search...">
                            </form>
                        </div>
                        <div class="col-md-8">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table data-sortable class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <!--                            <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>-->
                            <th>From User</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Link</th>
                            <th>Created Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($notifiers as $key => $notifier): ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <!--                                <td><input type="checkbox" class="rows-check"></td>-->
                                <td><strong><?php echo $notifier->fromUser;?></strong></td>
                                <td><strong><?php echo $notifier->title;?></strong></td>
                                <td><strong><?php echo $notifier->body;?></strong></td>
                                <td><strong><?php if(!empty($notifier->link)){ ?> <a href="<?php echo $notifier->link; ?>">[LINK]</a><?php }?></strong></td>
                                <td><strong><?php echo $notifier->created;?></strong></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="data-table-toolbar">
                    <ul class="pagination" style="margin-bottom: 8px;">
                        <?php echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('class' => 'disabled','escape' => false)); ?>
                        <?php echo $this->Paginator->numbers(array('modulus' => 2 ,"first"=>2,'last' => 2  )); ?>
                        <?php echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('class' => 'disabled','escape' => false)); ?>
                    </ul>
                    <p style="marrgin-left:40px;"><?php echo $this->Paginator->counter(); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer>
    Son Nguyen &copy; 2014
    <div class="footer-links pull-right">
        <a href="#">About</a><a href="#">Support</a><a href="#">Terms of Service</a><a href="#">Legal</a><a href="#">Help</a><a href="#">Contact Us</a>
    </div>
</footer>


<script>
    $(".btnDelDepartment").on("click", function(e){
        notifyConfirm({title: 'Delete!!!' ,cate: '\"' + $(this).data("name") + '\" department' ,id:$(this).data('value')});
    });
    $(".editDepartment").on("click", function(e){
        resetDepartmentForm();
        $('#titleDepartment').html('Edit<strong> Department</strong>');
        $('#dep_name').val($(this).parents(':eq(2)').find( "td:eq(2)").text());
        $('#dep_tel').val($(this).parents(':eq(2)').find( "td:eq(3)").text());
        $('#dep_address').val($(this).parents(':eq(2)').find( "td:eq(4)").text());
        if($(this).parents(':eq(2)').find( "td:eq(5)").data("status"))
            $('input:radio[id="status1"]').iCheck('check');
        else
            $('input:radio[id="status2"]').iCheck('check');
        $('<input>').attr({
            type: 'hidden',
            id: 'department_id',
            name: 'department_id',
            value: $(this).data("value")
        }).appendTo('#createDepartment');
    });
    $("#btnAddDepartment").on("click", function(e){
        $('#titleDepartment').html('Add<strong> Department</strong>');
        resetDepartmentForm();
    });
    $("#btnResetDepartment").on("click", function(e){
        resetDepartmentForm();
        $('#titleDepartment').html('Add<strong> Department</strong>');
    });
    function resetDepartmentForm() {
        $( "#department_id" ).remove( );
        $('#createDepartment').trigger('reset');
    }




    $(function(){
        //listen for click events from this style
        $(document).on('click', '.notifyjs-metro-base .no', function() {
            //programmatically trigger propogating hide event
            $(this).trigger('notify-hide');
        });
        $(document).on('click', '.notifyjs-metro-base .yes', function() {
            //show button text
//            console($(this).data('value')));
            //call ajax to delete this items

            $.ajax({
                type: "GET",
                url:   '/department/delete.json',
                dataType: 'text',
                async:false,
                data: {id:$(this).data('value')},
                success: function (data) {
                    console.log(data);
//                    $('.btnDelDepartment').parents(':eq(2)').remove();
                    var res = JSON.parse(data);
                    notify('success',{title: res.result.status ,message: res.result.response,position:'top center'});
                    location.reload();
                    return true;
                }
            });
            //hide notification
            $(this).trigger('notify-hide');
        });
    })


</script>