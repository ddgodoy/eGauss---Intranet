<?php $mnGetModule = $sf_params->get('module') ?>
<ul>
    <li>
            <a href="<?php echo url_for('@user') ?>" class="first<?php echo $mnGetModule=='user' ? ' selected' : '' ?>">
                    <?php echo __('Users') ?>
            </a>
            <a href="<?php echo url_for('@affiliated') ?>" class="first<?php echo $mnGetModule=='affiliated' ? ' selected' : '' ?>">
                    <?php echo __('Empresas Participadas') ?>
            </a>
            <a href="<?php echo url_for('@analyzed') ?>" class="first<?php echo $mnGetModule=='analyzed' ? ' selected' : '' ?>">
                    <?php echo __('Empresas Analizadas') ?>
            </a>
            <a href="<?php echo url_for('@information') ?>" class="first<?php echo $mnGetModule=='information' ? ' selected' : '' ?>">
                    <?php echo __('Información') ?>
            </a>
            <a href="<?php echo url_for('@shareholders') ?>" class="first<?php echo $mnGetModule=='shareholders' ? ' selected' : '' ?>">
                    <?php echo __('Juntas de Accionistas') ?>
            </a>
            <?php if($sf_user->hasCredential('super_admin')): ?>
            <a href="<?php echo url_for('@billing') ?>" class="first<?php echo $mnGetModule=='billing' ? ' selected' : '' ?>">
                    <?php echo __('Facturación') ?>
            </a>
            <?php endif; ?>
    </li>
</ul>    