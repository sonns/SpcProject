<?php if(isset($result['status']) && $result['status'] === 'Success'){
    ?>
        <li>
            <div class="the-date">
                <span><?=$this->Time->i18nFormat($result['response']->created,'dd');?></span>
                <small><?=$this->Time->i18nFormat($result['response']->created,'MMM');?></small>
            </div>
            <h4><b><?=$result['response']->username;?></b></h4>
            <p>
                <?=$result['response']->contents;?>
            </p>
        </li>
<?php }?>