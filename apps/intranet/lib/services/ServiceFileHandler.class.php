<?php

class ServiceFileHandler
{
    /**
     * Set upload folder by entity
     *
     * @param string $entity
     * @return string $folder
     */
    public static function getUploadFolder($entity, $property = false)
    {
        $upload_folder = sfConfig::get('sf_web_dir').'/uploads/';
        $entity_folder = $upload_folder.$entity.'/';
        $actual_year_folder = $entity_folder.date('Y').'/';
        $property_folder = $entity_folder.'property_'.$property.'/';
        ## create entity folder
        if (!is_dir($entity_folder)) {
                mkdir($entity_folder); chmod($entity_folder, 0777);
        }
        if (!$property)
        {
          ## create actual year folder
          if (!is_dir($actual_year_folder)) {
            mkdir($actual_year_folder); chmod($actual_year_folder, 0777);
          }
        } else {
          ## create property folder
          if (!is_dir($property_folder)) {
            mkdir($property_folder); chmod($property_folder, 0777);
          }
        }
        return $entity_folder;
    }

    /**
     * Get thumbnail image
     *
     * @param string $image
     * @return string
     */
    public static function getThumbImage($image, $prefix = 'c')
    {
            return str_replace('/', '/'.$prefix.'_', $image);
    }

} // end class