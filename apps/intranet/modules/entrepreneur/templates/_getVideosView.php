<?php if(count($array_videos)>0): ?>
<script type="text/javascript" src="/fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript">
$(document).ready(function() {
    /*
     *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
     */
    $('.fancybox-media')
    .fancybox({
            openEffect : 'none',
            closeEffect : 'none',
            prevEffect : 'none',
            nextEffect : 'none',

            arrows : false,
            helpers : {
                    media : {},
                    buttons : {}
            }
    });    
});
</script>
<fieldset>
    <legend>Videos</legend>
    <table width="100%" cellspacing="4" cellpadding="0" border="0">
        <?php foreach($array_videos AS $k=>$v):?>
        <tr>
            <td width="3%"><img src="/images/video.jpeg" border="0" width="20" height="20"/></td>
            <td width="35%">
                <a class="fancybox-media" title="<?php echo $v['name'] ?>" href="<?php echo $v['url'] ?>">
                    <label style="cursor: pointer"><strong><?php echo $v['name'] ?></strong></label>
                </a>        
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</fieldset>    
<?php endif; ?>        