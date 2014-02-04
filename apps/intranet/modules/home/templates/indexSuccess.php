<div class="content">
    <div class="columnas col2" style="width:98%;">
        <div class="paneles" style="width:33%;height:602px;float:left;overflow:auto;">
            <div id="conten-calendar">
                <?php include_component('calendar', 'calendar') ?>
            </div>    
            <?php if(count($calendar)>0): ?>
            <br />
            <h1><?php echo __('Date').' '.date('d/m/Y') ?></h1>
            <br />
            <div style="overflow-y: auto; height: 310px;">
            <table width="100%" cellspacing="0" border="0" class="listados">
                <tr>
                    <th width="5%"></th>  
                    <th width="25%" align="left"><?php echo __('Date') ?></th>
                    <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                    <th><?php echo __('Hora') ?></th>
                </tr>
                <?php foreach ($calendar AS $item): ?>
                    <?php $show_module = $item->getTypeCalendarId()==2?'shareholders': 'calendar' ?>
                <tr class="<?php if (!empty($odd)) { echo 'gris'; $odd=0; } else { echo 'blanco'; $odd=1; } ?>" style="cursor: pointer" onclick="document.location='<?php echo url_for('@'.$show_module.'-show?id='.$item->getId().'&sch_year='.date('Y').'&sch_month='.date('m').'&sch_day='.date('d')) ?>';">
                        <td>
                            <?php $src_img = $item->getTypeCalendarId()==2?'convocar.png':'calendario.gif'; ?>
                            <img src="/images/<?php echo $src_img ?>" border="0"/>
                        </td>
                        <td><?php echo sprintf("%02d",$item->getDay()).'/'.sprintf("%02d",$item->getMonth()).'/'.$item->getYear() ?></td>
                        <td><?php echo $item->getSubject() ?></td>
                        <td><?php echo $item->getHourFrom() ?></td>
                    </tr> 
                <?php endforeach; ?>
            </table>
            </div>     
            <?php endif; ?>       
        </div>
        <div style="width:33%;float:left;">
            <?php if($shareholders): ?>
                <div class="paneles">
                    <h1><?php echo __('Juntas de Accionistas') ?></h1>
                    <div style="overflow-y: auto; height: 95px;">
                    <table width="100%" cellspacing="0" border="0" class="listados">
                        <tr>
                          <th width="5%"></th>  
                          <th width="25%" align="left"><?php echo __('Date') ?></th>
                          <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                          <th><?php echo __('Hora') ?></th>
                        </tr>
                        <tr style="cursor: pointer" onclick="document.location='<?php echo url_for('@shareholders-show?id='.$shareholders->getId().'&sch_year='.$shareholders->getYear().'&sch_month='.$shareholders->getMonth().'&sch_day='.$shareholders->getDay()) ?>';">
                            <td>
                                <img src="/images/convocar.png" border="0"/>
                            </td>
                            <td><?php echo sprintf("%02d",$shareholders->getDay()).'/'.sprintf("%02d",$shareholders->getMonth()).'/'.$shareholders->getYear() ?></td>
                            <td><?php echo $shareholders->getSubject() ?></td>
                            <td><?php echo $shareholders->getHourFrom() ?></td>
                        </tr> 
                    </table>
                    </div>    
                </div>
            <?php endif; ?>   
            <?php if(count($information)>0): ?>
                <div class="paneles">
                    <h1><?php echo __('Información') ?></h1>
                    <div style="overflow-y: auto; height: 175px;">
                    <table width="100%" cellspacing="0" border="0" class="listados">
                        <tr>
                          <th width="5%"></th>  
                          <th width="25%" align="left"><?php echo __('Date') ?></th>
                          <th width="65%" align="left"><?php echo __('Titulo') ?></th>
                        </tr>
                        <?php foreach ($information AS $value): ?>
                        <tr class="<?php if (!empty($odd_i)) { echo 'gris'; $odd_i=0; } else { echo 'blanco'; $odd_i=1; } ?>" style="cursor: pointer" onclick="document.location='<?php echo url_for('@information-show?id='.$value->getId()) ?>'">
                            <td>
                                <img src="/images/acta.png" border="0"/>
                            </td>
                            <td><?php echo Common::getFormattedDate($value->getCreatedAt() , 'd/m/Y H:i:s') ?></td>
                            <td><?php echo $value->getName() ?></td>
                        </tr> 
                        <?php endforeach; ?>
                    </table>
                    </div>    
                </div>
            <?php endif; ?>   
            <?php if(count($notification)>0): ?>
                <div class="paneles">
                    <h1><?php echo __('Notifications') ?></h1>
                    <div style="overflow-y: auto; height: 175px;">
                    <table width="100%" cellspacing="0" border="0" class="listados">
                        <tr>
                          <th width="5%"></th>  
                          <th width="25%" align="left"><?php echo __('Date') ?></th>
                          <th width="65%" align="left"><?php echo __('Subject') ?></th>
                        </tr>
                        <?php foreach ($notification AS $value): ?>
                                <?php 
                                   switch ($value->getType()) {
                                           case 'company_affiliated':
                                               $sf_module = 'affiliated';
                                               $id_type   = $value->getRegisteredCompaniesId();
                                            break;
                                            case 'company_analyzed':
                                               $sf_module = 'analyzed';
                                               $id_type   = $value->getRegisteredCompaniesId(); 
                                            break;
                                             case 'information':
                                               $sf_module = 'information';
                                               $id_type   = $value->getInformationId();  
                                            break;
                                            case 'contracts':
                                               $sf_module = 'contracts';
                                               $id_type   = $value->getContractsIntermediationId();  
                                            break;
                                 } ?>
                        <tr class="<?php if (!empty($odd_n)) { echo 'gris'; $odd_n=0; } else { echo 'blanco'; $odd_n=1; } ?>" style="cursor: pointer" onclick="document.location='<?php echo url_for('@'.$sf_module.'-show?id='.$id_type) ?>'">
                            <td>
                                <img src="/images/icon_message.gif" border="0"/>
                            </td>
                            <td><?php echo Common::getFormattedDate($value->getCreatedAt() , 'd/m/Y H:i:s') ?></td>
                            <td><?php echo $value->getSubject() ?></td>
                        </tr> 
                        <?php endforeach; ?>
                    </table>
                    </div>    
                </div>
            <?php endif; ?>   
        </div>  
        <div style="width:31%;float:right;">
            <div id="billing">
                <?php include_component('billing', 'getBillingByMonth') ?> 
            </div>
            <div id="contracts">
                <?php include_component('contracts', 'getContractsByMonth') ?> 
                <?php include_component('contracts', 'getRankingSocios') ?> 
            </div>
        </div>
    </div>
    <?php include_component('affiliated', 'getAffiliated') ?>
</div>
