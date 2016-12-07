<div class="text-center user-profile-2">
    <h4><?=__('hi')?>, <b><?php echo  (empty($userInfo['profile'])) ? $userInfo['username'] : $userInfo['profile']['first_name'] . ' ' . $userInfo['profile']['last_name'];?></b></h4>
    <h5><?= $userInfo['role'][0]->display_name?></h5>
    <ul class="list-group">
        <li class="list-group-item">
            <span class="badge"><?= $requestCount;?></span>
            <?= __('all_request')?>
        </li>
        <li class="list-group-item">
<!--            <span class="badge">--><?//= $requestCount;?><!--</span>-->
            <?= __('waiting_request')?>
        </li>
        <li class="list-group-item">
<!--            <span class="badge">--><?//= $requestCount;?><!--</span>-->
            <?= __('approve_request')?>
        </li>
    </ul>
</div>