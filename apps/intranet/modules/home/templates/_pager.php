<div class="paginado" style="float:left;">
<?php if ($pager->haveToPaginate()): ?>
    <?php
        if ($pager->getPage() != 1) {
            echo link_to('First', $url.'?page=1'.$params, array('class' => 'flecha l_all'));
        echo link_to('Previous', $url.'?page='.$pager->getPreviousPage().$params, array('class' => 'flecha l'));
        }
        foreach ($pager->getLinks() as $page) {
        echo link_to_unless($page == $pager->getPage(), $page, $url.'?page='.$page.$params);
    }
    if ($pager->getPage() != $pager->getLastPage()) {
        echo link_to('Next', $url.'?page='.$pager->getNextPage().$params, array('class' => 'flecha r'));
        echo link_to('Last', $url.'?page='.$pager->getLastPage().$params, array('class' => 'flecha r_all'));
      }
    ?>
<?php endif; ?>
<div class="info" style="float: left;">Hay <?php echo $oCant ?> Registros</div>
</div>