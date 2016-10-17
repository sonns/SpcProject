<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tbl Master Account'), ['action' => 'edit', $tblMasterAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tbl Master Account'), ['action' => 'delete', $tblMasterAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tblMasterAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tbl Master Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tbl Master Account'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tblMasterAccounts view large-9 medium-8 columns content">
    <h3><?= h($tblMasterAccount->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Login Id') ?></th>
            <td><?= h($tblMasterAccount->login_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tblMasterAccount->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Del Flg') ?></th>
            <td><?= $this->Number->format($tblMasterAccount->del_flg) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($tblMasterAccount->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($tblMasterAccount->modified) ?></td>
        </tr>
    </table>
</div>
