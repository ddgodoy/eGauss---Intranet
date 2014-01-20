<?php use_helper('DateForCalendar') ?>
<script>
    $('docuemt').ready(function(){
        $('#last-month').click(function(){
            var data_date = $(this).attr('alt');
            new_calendar(data_date)
        })
        
        $('#next-month').click(function(){
            var data_date = $(this).attr('alt');
            new_calendar(data_date)
        })
    })
    function new_calendar(data_date)
    {
        var url = '<?php echo url_for('@calendar-get-date?') ?>'+'?'+data_date
        jQuery.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('#conten-calendar').html(data);
                }
            });
    }
</script>
<h1><?php echo __('Calendar') ?></h1>
<div id="contenedor_calendario">
  <table width="100%" border="0" cellpadding="0" cellspacing="3" class="matriz">
    <tbody>
      <tr>
        <td align="right">
            <?php echo image_tag('flechita_left2.gif', array('border' => 0, 'style'=>'cursor: pointer', 'id'=>'last-month', 'alt'=>mes_anterior($year, $month))) ?>
        </td>
        <td colspan="5" align="center" style="font-weight: bold; font-size: 22px;">
            <?php echo nombre_mes($month) ?> <?php echo $year ?>
        </td>
        <td>
            <?php echo image_tag('flechita2.gif', array('border' => 0, 'style'=>'cursor: pointer', 'id'=>'next-month', 'alt'=>mes_siguiente($year, $month))) ?></td>
        </td>
      </tr>
      <tr class="cal_nombre_dia">
        <td>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td>
      </tr>
      <?php 
       $i = 0; foreach (weeks($year, $month) as $week): $i++; ?>
      <tr>
        <?php foreach ($week as $kday => $day): ?>
        <?php
          $eventDay = !empty($calendar_list_array[$day]) ? true : false;
        ?>
        <?php
        	$classOnTheFly = $day ? 'cal_dia' : 'cal_fix';
                $classOnTheFly = $eventDay?'cal_ocupada':$classOnTheFly;
                $classOnTheFly = $day == date('d') && $month == date('m')?'cal_dia_now':$classOnTheFly;
                $classOnTheFly = $day == $sch_day && $month == $sch_month && $year == $sch_year?'cal_dia_select':$classOnTheFly;
        ?>
        <td id="day_<?php echo $day ?>" class="<?php echo $classOnTheFly ?>" onclick="document.location='<?php echo url_for('@calendar?sch_year='.$year.'&sch_month='.$month.'&sch_day='.$day) ?>';">
        	<?php
                   $link_day = $day ? $day: '';	
                   echo $link_day;
        	?>
        </td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>