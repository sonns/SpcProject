<?php if($result['status']): ?>
    <div class="alertMessage alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $result['response'];?>
    </div>
<?php else: ?>
    <div class="alertMessage alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $result['response'];?>
    </div>
<?php endif;?>
