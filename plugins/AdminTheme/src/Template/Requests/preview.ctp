<div class="row">
    <div class="col-sm-10 text-right">
    </div>
    <div class="col-sm-2 text-right">
        <a id="btnPrint" name="btnPrint"  class="btn btn-primary btn-sm invoice-print"><i class="icon-print-2"></i> Print</a>
    </div>
    <div class="col-sm-12 portlets" id="frmRequests">

        <div class="widget">
            <div style="margin-bottom: 50px; margin-top: 20px;" class="widget-header text-center">
                <h2 style="font-size: 30px;"><strong><?= __("form_request")?></strong></h2>
                <br>
                <br>
            </div>
            <p></p>


            <div style="width: 60%; margin-left: 15px;">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td width="30%"><?= __("request_drafting_date")?></td>
                        <td width="70%">
<!--                            <a href="#" id="drafting_date" data-type="combodate" data-maxYear="2030" data-value="2016-05-15" data-format="YYYY-MM-DD" data-viewformat="YYYY year MM/DD" data-template="YYYY  / MMM / D" data-pk="10"  data-title="Select Drafting Date"></a>-->
                            <span style="float: right;"><strong><?= __("request_year_month_day", [ $requestDetail->created->format('Y'), $requestDetail->created->format('m'), $requestDetail->created->format('d')])?><strong></span></td>
                    </tr>
                    <tr>
                        <td width="30%"><?= __("request_dep")?></td>
                        <td width="70%"><?= $requestDetail->department_name?></td>
                    </tr>
                    <tr>
                        <td width="30%"><?= __("request_name")?></td>
                        <td width="70%"><?= $requestDetail->alias_name?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="widget-content padding">
                <p></p>
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td width="15%"><?= __("request_subject")?></td>
                        <td width="60%"><?= $requestDetail->title?></td>
                        <td width="10%"><?= __("request_money")?></td>
                        <td width="15%"><?=  number_format($requestDetail->price)?></td>
                    </tr>
                    <tr>
                        <td><?= __("request_cate")?></td>
                        <td colspan="3">
                            <?= $requestDetail->categories_name?>
                        </td>
                    </tr>
                    <tr style="height: 120px;">
                        <td><?= __("request_des")?></td>
                        <td colspan="3">
                            <?= $requestDetail->description?>
                        </td>
                    </tr>
                    <tr style="height: 140px;">
                        <td><?= __("request_effect")?></td>
                        <td colspan="3">
                            <?= $requestDetail->effectiveness?>
                        </td>
                    </tr>
                    <tr style="height: 120px;">
                        <td><?= __("request_reason")?></td>
                        <td colspan="3">
                            <?= $requestDetail->reason?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= __("request_approve_date")?></td>
                        <td colspan="3">
                            <?= $requestDetail->appr_date->format('Y/m/d')?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= __("request_attach")?></td>
                        <td colspan="3">
                            <?= $requestDetail->attach?>
                        </td>
                    </tr>

                    <tr style="height: 150px;">
                        <td><?= __("request_note")?></td>
                        <td colspan="3">
                            <?= $requestDetail->note?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
<!--                <div class="col-sm-6">-->
<!--                </div>-->
                <div style="width: 500px; float: right; padding-bottom: 15px;">

                    <table id="user" class="table table-bordered table-striped" style="clear: both">
                        <tbody>
                        <tr>
                            <td  style="vertical-align: middle;" rowspan="2" width="10%"><?= __("request_representative_confirmed")?></td>
                            <td width="10%" style="text-align: center;vertical-align: middle;"><?= __("request_date")?>:</td>
                            <td style="vertical-align: middle;"  rowspan="2" width="10%"><?= __("request_approve_by")?></td>
                            <td width="10%" style="text-align: center;vertical-align: middle;"><?= __("request_date")?></td>
                            <td style="vertical-align: middle;" rowspan="2" width="10%"><?= __("request_requester")?></td>
                            <td width="10%"  style="text-align: center;vertical-align: middle;"><?= __("request_date")?></td>
                        </tr>
                        <tr>
                            <td width="22%" style="height: 100px;text-align: center;vertical-align: middle;">
                                <?php if(isset($requestDetail->top_status) && (int)$requestDetail->top_status === 1)
                                {
                                    echo $requestDetail->top_name;
                                }
                                ?>
                            </td>
                            <td width="22%" style="text-align: center;vertical-align: middle;">
                                <?php if(isset($requestDetail->manager_status) && (int)$requestDetail->manager_status === 1)
                                {
                                    echo $requestDetail->manager_name;
                                }
                                ?>

                            </td>
                            <td width="22%" style="text-align: center;vertical-align: middle;">
                                <?= $requestDetail->alias_name?>
                            </td>


                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-select/bootstrap-select.min.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-inputmask/inputmask.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-xeditable/demo/jquery.mockjax.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-xeditable/demo/demo-mock.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-select2/select2.min.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/jquery-clndr/moment-2.5.1.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/bootstrap-typeahead/bootstrap3-typeahead.min.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/ckeditor/ckeditor.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/libs/ckeditor/adapters/jquery.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/js/pages/advanced-forms.js',array('block' => 'scriptBlock')) ?>
<?= $this->Html->script('AdminTheme./assets/js/printThis.js',array('block' => 'scriptBlock')) ?>
<?php $this->Html->scriptStart(array('block' => 'scriptBlock')); ?>
$(function () {
$("#btnPrint").click(function () {
$("#frmRequests").printThis();
});
});
<?php $this->Html->scriptEnd();?>
<!--<script src="assets/js/pages/advanced-forms.js"></script>-->

<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select/bootstrap-select.min.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select2/select2.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-xeditable/css/bootstrap-editable.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select2/select2.css',array('block' => 'cssBlock')) ?>