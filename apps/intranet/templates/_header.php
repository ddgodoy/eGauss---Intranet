<?php if($sf_user->isAuthenticated()): ?>
<div class="head">
    <div class="up_bar">
            <!--<div class="links"><a href="#"><span>new option</span></a></div>-->
            <div class="grl">
                    <a href="<?php echo url_for('@homepage') ?>" class="home"><?php echo __('Home') ?></a>
                    <a href="<?php echo url_for('@my-profile?id='.$sf_user->getAttribute('user_id').'&profile=my-profile') ?>" class="datos"><?php echo __('My profile') ?></a>
                    <a href="<?php echo url_for('@logout') ?>" class="cerrar" style="margin-left:20px;">
                            <?php echo __('Close session') ?>
                    </a>
            </div>
    </div>
    <?php include_component('home', 'logo') ?>
    <?php include_component('home', 'user') ?>
    <div class="basics_links"><!--<a href="#"><?php //echo __('Help') ?></a>--></div>
    <div class="menu"><?php include_partial('home/menu') ?></div>
</div>
<?php else: ?>
<div class="head login">
        <img class="logo" src="/images/login_logo.png" alt="Home" style="margin-top:90px;" />
</div>
<?php endif; ?>
