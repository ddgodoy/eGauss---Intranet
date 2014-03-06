<?php

/**
 * home actions.
 *
 * @package    sf_icox
 * @subpackage home
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
   /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->getUser()->setCulture('es');

        if ($this->getUser()->hasCredential('super_admin'))
        {
            $client = new Google_Client();
            $client->setClientId('394341489547.apps.googleusercontent.com');
            $client->setClientSecret('EqhEQdb4YDZc4ZxXtIh1HskA');
            $client->setRedirectUri('http://egauss-intranet.icox.com');
            $client->setScopes(array('https://www.googleapis.com/auth/drive'));
            $client->setAccessType('online');

            $service = new Google_AnalyticsService($client);

            if ($request->getParameter('code')) {
                $this->getUser()->setAttribute('accessToken', $client->authenticate($request->getParameter('code')));
                $this->redirect('@homepage'); 
            } elseif (!$this->getUser()->getAttribute('accessToken')) {
                $client->authenticate();
            }
        }
        $this->shareholders = CalendarTable::getInstance()->findOneByNextAndTypeCalendarId(1,2);
        $this->information  = InformationTable::getInstance()->getInformation();
        $this->notification = NotificationsTable::getInstance()->getNotifications($this->getUser()->getAttribute('user_id'));
        $this->calendar     = CalendarTable::getInstance()->getCalendarByUserAndDate($this->getUser()->getAttribute('user_id'), date('Y'), date('m'), date('d'));
    }
    
    /**
     * google drive
     * @param sfWebRequest $request
     */
    public function executeGoogleDrive(sfWebRequest $request)
    {
        $this->name = '';
        $this->error = array();
        $this->msj_ok =false;
        
        if ($request->isMethod('POST'))
        {
            $client = new Google_Client(); 
            $client->setAccessToken($this->getUser()->getAttribute('accessToken'));
            $service = new Google_DriveService($client);
            
            $files_upload = $_FILES['file'];   
            //Insert a file
            $file = new Google_DriveFile();
            $file->setTitle(str_replace(' ', '-', $files_upload['name']));
            $file->setDescription(str_replace(' ', '-', $files_upload['name']));
            $file->setMimeType($files_upload['type']);
           
            $data = file_get_contents($files_upload['tmp_name']);

            $createdFile = $service->files->insert($file, array(
                  'data' => $data,
                  'mimeType' => $files_upload['type'],
                ));

            //Give everyone permission to read and write the file
            $permission = new Google_Permission();
            $permission->setRole('writer');
            $permission->setType('anyone');
            $permission->setValue('me');
            $service->permissions->insert($createdFile['id'], $permission);
            
            $temp_file = new TempsDocuments();
            $temp_file->setName($createdFile['title']);
            $temp_file->setIcon($createdFile['iconLink']);
            $temp_file->setUrl($createdFile['alternateLink']);
            $temp_file->save();

            if ($temp_file) {
             $this->msj_ok = true;   
            }
        }
        $this->setLayout('layout_iframe');
    }        
    
   /**
    * Executes logout action
    *
    * @param sfWebRequest $request
    */
   public function executeLogout(sfWebRequest $request)
   {  	
         ServiceAuthentication::closeSessionProcess();

         $this->redirect('@homepage');
   }
   
}
?>
