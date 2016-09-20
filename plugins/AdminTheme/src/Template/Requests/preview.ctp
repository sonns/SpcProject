<div class="row">
    <div class="col-sm-12 portlets" id="frmRequests">

        <div class="widget">
            <div class="widget-header text-center">
                <h2><strong><?= __("form_request")?></strong></h2>
                <br>
                <br>
            </div>
            <p></p>
            <div class="col-sm-6">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td width="30%"><?= __("request_drafting_date")?></td>
                        <td width="70%">
                            <a href="#" id="drafting_date" data-type="combodate" data-maxYear="2030" data-value="2016-05-15" data-format="YYYY-MM-DD" data-viewformat="YYYY/MM/DD" data-template="YYYY  / MMM / D" data-pk="10"  data-title="Select Drafting Date"></a>
                            <span style="float: right;"><?= __("request_year_month_day")?></span></td>
                    </tr>
                    <tr>
                        <td width="30%"><?= __("request_dep")?></td>
                        <td width="70%"><a href="#" id="request_dep" data-type="text" data-pk="1" data-title="Enter department">VN team</a></td>
                    </tr>
                    <tr>
                        <td width="30%"><?= __("request_name")?></td>
                        <td width="70%"><a href="#" id="request_name" data-type="text" data-pk="1" data-title="Enter username">Son Nguyen</a></td>
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
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">Request abc</a></td>
                        <td width="5%"><?= __("request_money")?></td>
                        <td width="15%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">290.000</a></td>
                    </tr>
                    <tr>
                        <td><?= __("request_des")?></td>

                        <td colspan="3">

                            <a href="#" id="txtDes" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="display: inline;">awesome user!</a>


                        </td>
                    </tr>
                    <tr>
                        <td><?= __("request_effect")?></td>
                        <td colspan="3">
                            <a href="#" id="txtEffect" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="display: inline;">awesome user!</a>
<!--                            <a href="#" id="event" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1"  data-title="Setup event date and time"></a>-->
                        </td>
                    </tr>



                    <tr>
                        <td><?= __("request_reason")?></td>
                        <td colspan="3">
                            <a href="#" id="txtReason" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="display: inline;">awesome user!</a>
                        </td>
                    </tr>


                    <tr>
                        <td><?= __("request_approve_date")?></td>
                        <td colspan="3">
                            <a href="#" id="approve_date" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" data-placement="right" data-title="When you want vacation to start?" class="editable editable-click" data-original-title="" title="" style="background-color: rgba(0, 0, 0, 0);">20.02.2013</a>
                            </td>
                    </tr>

                    <tr>
                        <td><?= __("request_attach")?></td>
                        <td colspan="3"><a href="#" id="tags" data-type="select2" data-pk="1" data-title="Enter tags">html, javascript</a></td>
                    </tr>

                    <tr>
                        <td><?= __("request_note")?></td>
                        <td colspan="3">
                            <a href="#" id="txtNote" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="display: inline;">awesome user!</a></td>
<!--                            <a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome content!</a></td>-->
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">

                    <table id="user" class="table table-bordered table-striped" style="clear: both">
                        <tbody>
                        <tr>
                            <td  style="vertical-align: middle;" rowspan="2" width="10%"><?= __("request_representative_confirmed")?></td>
                            <td width="10%"><?= __("request_date")?>:</td>
                            <td style="vertical-align: middle;"  rowspan="2" width="10%"><?= __("request_approve_by")?></td>
                            <td width="10%"><?= __("request_date")?></td>
                            <td style="vertical-align: middle;" rowspan="2" width="10%"><?= __("request_requester")?></td>
                            <td width="10%"><?= __("request_date")?></td>
                        </tr>
                        <tr>
                            <td width="22%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br> 123<br><br></a></td>
                            <td width="22%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br> 123<br><br></a></td>
                            <td width="22%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br> 123<br><br></a></td>


                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<?php //$this->Html->scriptStart(array('block' => 'scriptBlock')); ?>
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
<?php //$this->Html->scriptEnd();?>
<!--<script src="assets/js/pages/advanced-forms.js"></script>-->


<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select/bootstrap-select.min.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select2/select2.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-xeditable/css/bootstrap-editable.css',array('block' => 'cssBlock')) ?>
<?= $this->Html->css('AdminTheme./assets/libs/bootstrap-select2/select2.css',array('block' => 'cssBlock')) ?>