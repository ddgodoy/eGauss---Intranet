<?php
/**
 * home components.
 *
 * @package    sf_icox
 * @subpackage home
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeComponents extends sfComponents
{
    /**
     * logo
     * @param sfWebRequest $request
     */
    public function executeLogo(sfWebRequest $request)
    {
        $this->_company_logo = 'images/logo.png';
        $this->_fixSize_logo = 'width="200"';

        if ($this->getUser()->getAttribute('user_company_logo')) {
                $this->_company_logo = 'uploads/company/'.$this->getUser()->getAttribute('user_company_logo');
                $this->_fixSize_logo = '';
        }
    }        
    
    /**
     * user
     * @param sfWebRequest $request
     */
    public function executeUser(sfWebRequest $request) {
        $this->_img_user = $this->getUser()->getAttribute('user_photo') ? 'uploads/user/'.ServiceFileHandler::getThumbImage($this->getUser()->getAttribute('user_photo')) : 'images/no_user.jpg';
    }
}
?>
