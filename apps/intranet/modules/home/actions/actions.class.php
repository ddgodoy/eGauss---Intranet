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
        $this->name          = $request->getParameter('name','');
        $this->description   = $request->getParameter('description','');
        $this->error         = array();
        $this->msj_ok        = false;
        $this->theme         = $request->getParameter('theme', 0);
        $this->categories    = $request->getParameter('categories', 1);
        $this->token_expired = false;
        
        if($this->getUser()->getAttribute('accessToken')){
            //   $google_token= json_decode($this->getUser()->getAttribute('accessToken'));
               $client = new Google_Client(); 
               $client->setAccessToken($this->getUser()->getAttribute('accessToken'));
           if($client->isAccessTokenExpired()){
               $this->token_expired = true;
               /*$accessToken = $this->get_oauth2_token($client->getAccessToken());
               echo $accessToken;
               exit();
               $client->refreshToken($this->getUser()->getAttribute('accessToken'));*/
            }
        }    
        
        if ($request->isMethod('POST') && !$this->token_expired)
        {  
            
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
            $temp_file->setName($this->name);
            $temp_file->setDescription($this->description);
            $temp_file->setIcon($createdFile['iconLink']);
            $temp_file->setUrl($createdFile['alternateLink']);
            $temp_file->setDownload($createdFile['webContentLink']);
            if($this->theme == 1){
            $temp_file->setTypeInformationId($this->categories);    
            }
            $temp_file->save();

            if ($temp_file) {
             $this->msj_ok = true;   
            }
        }
        $this->setLayout('layout_iframe');
    }   
    
    /**
     * show document
     * @param sfWebRequest $request
     */
    public function executeShowDocument(sfWebRequest $request)
    {        
        $this->oValue = DocumentsRegisteredCompaniesTable::getInstance()->findOneById($request->getParameter('id'));
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
   
   /**
    * 
    * @global type $refreshToken
    * @param type $grantCode
    * @param type $grantType
    * @return type
    */
   protected  function get_oauth2_token($grantCode) {
        
        $oauth2token_url = "https://accounts.google.com/o/oauth2/token";
        $clienttoken_post = array(
        "client_id" => '394341489547.apps.googleusercontent.com',
        "client_secret" => 'EqhEQdb4YDZc4ZxXtIh1HskA');

        $clienttoken_post["refresh_token"] = $grantCode;
        $clienttoken_post["grant_type"] = "refresh_token";
         
        
        $curl = curl_init($oauth2token_url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $json_response = curl_exec($curl);
        curl_close($curl);

        $authObj = json_decode($json_response);

        //if offline access requested and granted, get refresh token
        if (isset($authObj->refresh_token)){
            global $refreshToken;
            $refreshToken = $authObj->refresh_token;
        }

        echo '<pre>';
        print_r($authObj);
        echo '</pre>';
        exit();
        $accessToken = $authObj->access_token;
        return $accessToken;
    }
   
}
?>
