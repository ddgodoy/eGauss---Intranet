<div class="user">
        <a href="<?php echo url_for('@my-profile?id='.$sf_user->getAttribute('user_id').'&profile=my-profile') ?>">
            <img src="/<?php echo $_img_user ?>" width="20" height="20" alt="User" border="0"/>
        </a>
        <strong><?php echo $sf_user->getAttribute('user_name').' '.$sf_user->getAttribute('user_last_name') ?></strong>
</div
