<div class="row">
    <div class="col-sm-12 portlets">
        <div class="widget">
            <div class="widget-header text-center">
                <h2><strong>Inline</strong> Editing</h2>
                <br>
                <br>
            </div>
            <div class="col-sm-6">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td width="30%">Simple text field</td>
                        <td width="70%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                    </tr>
                    <tr>
                        <td width="30%">Simple text field</td>
                        <td width="70%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                    </tr>
                    <tr>
                        <td width="30%">Simple text field</td>
                        <td width="70%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="widget-content padding">
                <p>Click to edit</p>
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td width="15%">Simple text field</td>
                        <td width="65%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                        <td width="5%">superuser</td>
                        <td width="15%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a></td>
                    </tr>
                    <tr>
                        <td>Empty text field, required</td>
                        <td colspan="3"><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname"></a></td>
                    </tr>
                    <tr>
                        <td>Select, local array, custom display</td>
                        <td colspan="3"><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-title="Select sex"></a></td>
                    </tr>
                    <tr>
                        <td>Select, remote array, no buttons</td>
                        <td colspan="3"><a href="#" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-title="Select group">Admin</a></td>
                    </tr>
                    <tr>
                        <td>Select, error while loading</td>
                        <td colspan="3"><a href="#" id="status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-title="Select status">Active</a></td>
                    </tr>

                    <tr>
                        <td>Datepicker</td>
                        <td colspan="3">

                            <span class="notready">not implemented for Bootstrap 3 yet</span>

                        </td>
                    </tr>
                    <tr>
                        <td>Combodate (date)</td>
                        <td colspan="3"><a href="#" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"></a></td>
                    </tr>
                    <tr>
                        <td>Combodate (datetime)</td>
                        <td colspan="3"><a href="#" id="event" data-type="combodate" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1"  data-title="Setup event date and time"></a></td>
                    </tr>



                    <tr>
                        <td>Textarea, buttons below. Submit by <i>ctrl+enter</i></td>
                        <td colspan="3"><a href="#" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">awesome user!</a></td>
                    </tr>


                    <tr>
                        <td>Checklist</td>
                        <td colspan="3"><a href="#" id="fruits" data-type="checklist" data-value="2,3" data-title="Select fruits"></a></td>
                    </tr>

                    <tr>
                        <td>Select2 (tags mode)</td>
                        <td colspan="3"><a href="#" id="tags" data-type="select2" data-pk="1" data-title="Enter tags">html, javascript</a></td>
                    </tr>

                    <tr>
                        <td>Select2 (dropdown mode)</td>
                        <td colspan="3"><a href="#" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"></a></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
            </div>
            <div class="col-sm-4">

                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                    <tr>
                        <td  style="vertical-align: middle;" rowspan="2" width="10%">Simple text field</td>
                        <td width="10%">Simple:</td>
                        <td style="vertical-align: middle;"  rowspan="2" width="10%">Simple text field</td>
                        <td width="10%">Simple:</td>
                        <td style="vertical-align: middle;" rowspan="2" width="10%">Simple text field</td>
                        <td width="10%">Simple</td>
                    </tr>
                    <tr>
                        <td width="100%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br>superuser<br><br></a></td>
                        <td width="100%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br>superuser<br><br></a></td>
                        <td width="100%"><a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username"><br>superuser<br><br></a></td>
                    </tr>
                    </tbody>
                </table>
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