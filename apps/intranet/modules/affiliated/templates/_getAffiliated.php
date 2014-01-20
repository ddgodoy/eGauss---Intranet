<?php if(count($array_new_affiliated)>0): ?>
<?php use_stylesheet('affiliated.css') ?>
<div class="project-sidebar-right clearfix" id="content-part">
    <?php foreach($array_new_affiliated AS $_value): ?>
    <?php $logo = $_value->getLogo()? '/uploads/company/'.$_value->getLogo() : '/images/no_image.jpg' ?>
    <div class="work-item">
        <a href="<?php echo url_for('@affiliated-show?id='.$_value->getId()) ?>">
            <img width="130" height="130" class="alignleft size-full wp-image-32" alt="<?php echo $_value->getName() ?>" src="<?php echo $logo ?>" title="<?php echo $_value->getName() ?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>