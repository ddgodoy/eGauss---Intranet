<?php $mnGetModule = $sf_params->get('module') ?>
<ul>
  <li>
        <?php if (!$sf_user->hasCredential('clientes') && !$sf_user->hasCredential('socios_empresa')): ?>
            <a href="<?php echo url_for('@user') ?>" class="first<?php echo $mnGetModule=='user' ? ' selected' : '' ?>">
                <?php echo __('Users') ?>
            </a>
            <a href="<?php echo url_for('@affiliated') ?>" class="first<?php echo $mnGetModule=='affiliated' ? ' selected' : '' ?>">
                <?php echo __('Participadas') ?>
            </a>
            <a href="<?php echo url_for('@analyzed') ?>" class="first<?php echo $mnGetModule=='analyzed' ? ' selected' : '' ?>">
                <?php echo __('Analizadas') ?>
            </a>
            <?php if ($sf_user->hasCredential('super_admin')): ?>
            <a href="<?php echo url_for('@company') ?>" class="first<?php echo $mnGetModule=='company' ? ' selected' : '' ?>">
                <?php echo __('Empresas') ?>
            </a>
            <a href="<?php echo url_for('@product') ?>" class="first<?php echo $mnGetModule=='product' ? ' selected' : '' ?>">
                <?php echo __('Productos') ?>
            </a>
            <?php endif; ?>
            <a href="<?php echo url_for('@information') ?>" class="first<?php echo $mnGetModule=='information' ? ' selected' : '' ?>">
                <?php echo __('Información') ?>
            </a>
            <a href="<?php echo url_for('@shareholders') ?>" class="first<?php echo $mnGetModule=='shareholders' ? ' selected' : '' ?>">
                <?php echo __('Juntas de Accionistas') ?>
            </a>
            <a href="<?php echo url_for('@investors') ?>" class="first<?php echo $mnGetModule=='investor' ? ' selected' : '' ?>">
                <?php echo __('Inversores') ?>
            </a>
            <a href="<?php echo url_for('@calendar_lista') ?>" class="first<?php echo $mnGetModule=='calendar' ? ' selected' : '' ?>">
                <?php echo __('Eventos') ?>
            </a>
            <a href="<?php echo url_for('@contracts') ?>" class="first<?php echo $mnGetModule=='contracts' ? ' selected' : '' ?>">
                <?php echo __('Intermediación') ?>
            </a>
            <a href="<?php echo url_for('@entrepreneur') ?>" class="first<?php echo $mnGetModule=='entrepreneur' ? ' selected' : '' ?>">
                <?php echo __('Emprendedores') ?>
            </a>
            <?php if ($sf_user->hasCredential('super_admin')): ?>
                    <a href="<?php echo url_for('@billing') ?>" class="first<?php echo $mnGetModule=='billing' ? ' selected' : '' ?>">
                <?php echo __('Facturación') ?>
                    </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="<?php echo url_for('@contracts') ?>" class="first<?php echo $mnGetModule=='contracts' ? ' selected' : '' ?>">
                <?php echo __('Intermediación') ?>
            </a>
        <?php endif; ?>
  </li>
</ul>