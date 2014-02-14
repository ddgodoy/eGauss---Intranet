<?php
/**
 * basecamp components
 *
 * @package    egauss
 * @subpackage basecamp
 * @author     pinika
 * @version    SVN: $Id: components.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class basecampComponents extends sfComponents
{
  /**
   * Create basecamp resume by project id
   * 
   * @param sfWebRequest $request
   */
  public function executeDrawResumen(sfWebRequest $request)
  {
		$this->datos = NewBasecamp::getResumenByProyecto($this->project_id);
  }

} // end class