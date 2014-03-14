<?php $mnGetModule = $sf_params->get('module') ?>
<ul>
  <li>
        <a href="<?php echo url_for('@user') ?>" class="first<?php echo $mnGetModule=='user' ? ' selected' : '' ?>">
            <?php echo __('Users') ?>
        </a>
        <a href="<?php echo url_for('@affiliated') ?>" class="first<?php echo $mnGetModule=='affiliated' ? ' selected' : '' ?>">
            <?php echo __('Participadas') ?>
        </a>
        <a href="<?php echo url_for('@analyzed') ?>" class="first<?php echo $mnGetModule=='analyzed' ? ' selected' : '' ?>">
            <?php echo __('Analizadas') ?>
        </a>
        <a href="<?php echo url_for('@information') ?>" class="first<?php echo $mnGetModule=='information' ? ' selected' : '' ?>">
            <?php echo __('Información') ?>
        </a>
        <a href="<?php echo url_for('@shareholders') ?>" class="first<?php echo $mnGetModule=='shareholders' ? ' selected' : '' ?>">
            <?php echo __('Juntas de Accionistas') ?>
        </a>
        <?php if ($sf_user->hasCredential('super_admin')): ?>
                <a href="<?php echo url_for('@billing') ?>" class="first<?php echo $mnGetModule=='billing' ? ' selected' : '' ?>">
            <?php echo __('Facturación') ?>
                </a>
                <a href="<?php echo url_for('@contracts') ?>" class="first<?php echo $mnGetModule=='contracts' ? ' selected' : '' ?>">
            <?php echo __('Intermediación') ?>
                </a>
                <a href="<?php echo url_for('@calendar_lista') ?>" class="first<?php echo $mnGetModule=='calendar' ? ' selected' : '' ?>">
            <?php echo __('Eventos') ?>
                </a>
                <?php /*<a href="<?php echo url_for('@investors') ?>" class="first<?php echo $mnGetModule=='investor' ? ' selected' : '' ?>">
            <?php echo __('Inversores') ?>
                </a> */ ?>
        <?php endif; ?>
  </li>
</ul>