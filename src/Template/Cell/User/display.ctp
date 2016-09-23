<div class="text-center user-profile-2">
    <h4>Hi, <b><?php echo  (empty($userInfo['profile'])) ? $userInfo['profile'] : $userInfo['profile']['first_name'] . ' ' . $userInfo['profile']['last_name'];?></b></h4>
    <h5><?=  $userInfo['role']['display_name']?></h5>
    <ul class="list-group">
        <li class="list-group-item">
            <span class="badge"><?= $requestCount;?></span>
            <?= __('All Request')?>
        </li>
        <li class="list-group-item">
            <span class="badge"><?= $requestCount;?></span>
            <?= __('Pending Request')?>
        </li>
        <li class="list-group-item">
            <span class="badge"><?= $requestCount;?></span>
            <?= __('Approve Request')?>
        </li>
    </ul>
</div>