<!-- Modal add department-->
<?php echo $this->element('Department/add') ?>
<!-- End div .md-modal .md-fade-in-scale-up -->

<!-- Page Heading Start -->
<div class="page-heading">
    <h1><i class='fa fa-table'></i> <?=__('department'). ' ' .__('list')?></h1>
</div>
<!-- Page Heading End-->
<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-header transparent">
                <div class="additional-btn">
                    <a href="<?php echo $this->Url->build(['controller'=>'departments','action'=>'add','add_dep'])?>" class="hidden reload"><i class="icon-ccw-1"></i></a>
                    <a href="<?php echo $this->Url->build(['controller'=>'departments','action'=>'delete','del_dep'])?>" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                </div>
            </div>
            <div class="widget-content">

                <div class="data-table-toolbar">

                    <div class="row">

                        <div class="col-md-4">

                            <form role="form">
                                <input type="text" class="form-control" placeholder="<?=__('search')?>...">
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="toolbar-btn-action">
                                <a data-modal="md-add-department" id="btnAddDepartment" class="btn btn-success md-trigger"><i class="fa fa-plus-circle"></i><?=__('add_new')?></a>
<!--                                <a data-modal="md-add-department" class="btn btn-danger md-trigger"><i class="fa fa-trash-o"></i>Delete</a>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table data-sortable class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th><?=__('stt')?></th>
<!--                            <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>-->
                            <th><?=__('dep_name')?></th>
                            <th><?=__('tel')?></th>
                            <th><?=__('address')?></th>
                            <th><?=__('status')?></th>
                            <th><?=__('create_date')?></th>
                            <th data-sortable="false"><?=__('action')?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($departments as $key => $department): ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
<!--                                <td><input type="checkbox" class="rows-check"></td>-->
                                <td><strong><?php echo $department->name;?></strong></td>
                                <td><strong><?php echo $department->tel;?></strong></td>
                                <td><strong><?php echo $department->address;?></strong></td>
                                <td data-status="<?= $department->status?>"> <span class="label <?php echo ($department->status) ? 'label-success' :'label-warning' ?>"><?php echo ($department->status) ? 'Active' :'Deactivate' ?></span></td>
                                <td><strong><?php echo $department->created;?></strong></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-edit')), '#' ,array( 'data-value' => $department->id , 'data-modal' => "md-add-department", 'style' => 'margin-right:4px;' ,'class'=>'btn btn-default md-trigger editDepartment','title'=>'__("edit")','data-toggle'=>"tooltip",'escape' => false ))?>
                                        <?php echo $this->Html->link($this->Html->tag('i', '', array('class'=>'fa fa-remove')),'#',array( 'data-value' => $department->id , 'data-name' => $department->name , 'class'=>'btn btn-danger btnDelDepartment','title'=>'__("del ")','data-toggle'=>"tooltip",'escape' => false ))?>
<!--                                        <a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>-->
<!--                                        <a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>-->
                                    </div>
                                </td>
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
        $('#titleDepartment').html('<strong><?=__("edit_department")?></strong>');
        $('#dep_name').val($(this).parents(':eq(2)').find( "td:eq(2)").text());
        $('#dep_tel').val($(this).parents(':eq(2)').find( "td:eq(3)").text());
        $('#dep_address').val($(this).parents(':eq(2)').find( "td:eq(4)").text());
//        alert($(this).parents(':eq(2)').find( "td:eq(5)").data("status"));
        if($(this).parents(':eq(2)').find( "td:eq(5)").data("status"))
            $('input:radio[id="status1"]').iCheck('check');
        else
            $('input:radio[id="status2"]').iCheck('check');
//        $('input:radio[name="status"]').attr("checked",true);
        $('<input>').attr({
            type: 'hidden',
            id: 'department_id',
            name: 'department_id',
            value: $(this).data("value")
        }).appendTo('#createDepartment');
    });
    $("#btnAddDepartment").on("click", function(e){
        $('#titleDepartment').html('<strong><?=__("add_department")?></strong>');
        resetDepartmentForm();
    });
    $("#btnResetDepartment").on("click", function(e){
        resetDepartmentForm();
        $('#titleDepartment').html('<strong><?=__("add_department")?></strong>');
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