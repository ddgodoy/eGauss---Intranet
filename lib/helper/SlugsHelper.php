<?php
function slugify($text, $separator = 'dash', $lowercase = TRUE)
{
    $text = strip_tags($text);
    $text = preg_replace("`\[.*\]`U","",$text);
    $text = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$text);
    $text = htmlentities($text, ENT_COMPAT, 'utf-8');
    $text = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $text );
    $text = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $text);

    if ($lowercase === TRUE)
    {
        $text = strtolower($text);
    }

    if($separator != 'dash')
    {
        $text = str_replace('-', '_', $text);
        $separator = '_';
    }
    else
    {
        $separator = '-';
    }

    return trim($text, $separator);
}
?>
