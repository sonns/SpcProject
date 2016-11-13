<?php if(count($arrComment)){
        foreach ($arrComment as $key => $comment){?>
<li>
    <div class="the-date">
        <span><?=$this->Time->i18nFormat($comment->created,'dd');?></span>
        <small><?=$this->Time->i18nFormat($comment->created,'MMM');?></small>
    </div>
    <h4><b><?=$comment->username;?></b></h4>
    <p>
        <?=$comment->contents;?>
    </p>
</li>
    <?php }}?>