<div class="content">
    <div class="leftside">
        <h1 class="titulos">
            <?php echo $oValue->getName() ?> 
            <span style="padding-left:20px;font-size:15px;">[&nbsp;<?php echo Common::getFormattedDate($oValue->getCreatedAt(),'d/m/Y') ?>&nbsp;]</span>
        </h1>
        <h6 class="titulos" style=" color: #1B6577"><?php echo $oValue->getTypeInformation()->getName() ?></h6>
        <?php if($oValue->getDescription()): ?>
        <fieldset>
                <table width="100%" cellspacing="4" cellpadding="2" border="0">
                        <tr>
                            <td class="text_detail"><?php echo html_entity_decode($oValue->getDescription()) ?></td>
                        </tr>
                </table>
        </fieldset>
        <?php endif; ?>
        <table width="45%" cellspacing="4" cellpadding="2" border="0">
            <tr>
                <td class="text_detail" style="vertical-align: middle ">
                    <a  href="<?php echo $oValue->getUrl() ?>" target="_blanck">
                        <img src="<?php echo $oValue->getIcon()  ?>" border="0" style="width:20px;height:20px;" title="Ver"/>
                        Ver Documento
                    </a>
                </td>
                <td class="text_detail" style="vertical-align: middle ">
                    <a  href="<?php echo $oValue->getDownload() ?>">
                        <img src="/images/descargar-documento.jpg" border="0" style="width:20px;height:20px;" title="Descargar"/>
                        Descargar Documento
                    </a>    
                </td>
            </tr>
        </table>
    </div>
</div>
