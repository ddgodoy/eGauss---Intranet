<?php

/**
 * basecamp actions.
 *
 * @package    sf_icox
 * @subpackage basecamp
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class basecampActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$sUser = sfContext::getInstance()->getUser();
  	
  	if ($sUser->getAttribute('user_role') == 'super_admin') {
  		$this->arrDatos = RunBasecamp::todosLosProyectos();
  	} else {
  		$this->arrDatos = AppUserTable::getInstance()->getProyectosForThisUser($sUser->getAttribute('user_id'));
  	}
  }

 /**
  * Executes task action
  *
  * @param sfRequest $request A request object
  */
  public function executeTask(sfWebRequest $request)
  {
		require_once sfConfig::get('sf_root_dir').'/lib/vendor/rest_basecamp/Basecamp.class.php';
  	
		$this->idPr = $request->getParameter('id');
  	$this->name = $request->getParameter('project');

		$this->datos = array();
		$this->aConn = RunBasecamp::getConnValues();
		
  	$conn = new Basecamp($this->aConn['baseUri'], $this->aConn['username'], $this->aConn['password']);

  	// mensajes
	  $oPosts = new DOMDocument();
	  $rPosts = $conn->getMessagesForProject($this->idPr);
	  $oPosts->loadXML($rPosts['body']);
	  
	  $xml_posts = $oPosts->getElementsByTagName('post');

	  if ($xml_posts->length > 0)
	  {
	  	foreach ($xml_posts as $post)
	  	{
	  		$post_code = $post->getElementsByTagName('id')->item(0)->nodeValue;
	  		$post_name = $post->getElementsByTagName('title')->item(0)->nodeValue;
	  		$posted_by = $post->getElementsByTagName('author-name')->item(0)->nodeValue;
	  		$post_date = Common::getFormattedDate($post->getElementsByTagName('posted-on')->item(0)->nodeValue);
	
	  		$this->datos[$post_date][$post_code] = array(
	  			'lista' => 'Ver más',
	  			'event' => 'Mensaje',
	  			'texto' => $post_name,
	  			'autor' => $posted_by,
	  			'label' => 'Publicado por',
	  			'color' => '#334e7d',
	  			'link'  => '/posts/'.$post_code.'/comments'
	  		);
	  	}
	  }
	  // lista de pendientes
  	$rTareas = $conn->getTodoListIdsForProject($this->idPr, 'pending');

  	foreach ($rTareas as $todo_id)
	  {
			// tareas
	  	$oLista = new DOMDocument();
	  	$rLista = $conn->getTodoList($todo_id);
	  	$oLista->loadXML($rLista['body']);
	
	  	$oItems = $oLista->getElementsByTagName('todo-item');
	  	
	  	foreach ($oItems as $todo)
	  	{
	  		if ($todo->getElementsByTagName('completed')->item(0)->nodeValue == 'false')
	  		{
	  			$td_completer = $todo->getElementsByTagName('completer-name');
	  			$td_responsab = $todo->getElementsByTagName('responsible-party-name');
	  			$td_createdby = $todo->getElementsByTagName('creator-name');
	  			
	  			if ($td_completer->length > 0)
	  			{
	  				$todo_labl = 'Completado por';
	  				$todo_autr = $td_completer->item(0)->nodeValue;
	  			}
	  			elseif ($td_responsab->length > 0)
	  			{
	  				$todo_labl = 'Asignado a';
	  				$todo_autr = $td_responsab->item(0)->nodeValue;
	  			} else {
	  				$todo_labl = 'Publicado por';
	  				$todo_autr = $td_createdby->item(0)->nodeValue;
	  			}
	  			$todo_name = $oLista->getElementsByTagName('name')->item(0)->nodeValue;
	  			$todo_code = $todo->getElementsByTagName('id')->item(0)->nodeValue;
	  			$todo_text = $todo->getElementsByTagName('content')->item(0)->nodeValue;
	  			$todo_date = Common::getFormattedDate($todo->getElementsByTagName('created-at')->item(0)->nodeValue);
	  			
	  			$this->datos[$todo_date][$todo_code] = array(
		  			'lista' => $todo_name,
		  			'event' => 'Tarea',
		  			'texto' => $todo_text,
		  			'autor' => $todo_autr,
		  			'label' => $todo_labl,
		  			'color' => '#b77103',
		  			'link'  => '/todo_lists/'.$todo_id.'#'.$todo_code
		  		);
		  		// comentarios
	  			$aComments = array();
	  			$oComments = new DOMDocument();
	  			$rComments = $conn->getRecentCommentsForResource('todo_items', $todo_code);
	  			$oComments->loadXML($rComments['body']);
	  			
	  			$xml_comment = $oComments->getElementsByTagName('comment');
	  			
	  			if ($xml_comment->length > 0)
	  			{
	  				foreach ($xml_comment as $comment)
	  				{
	  					$comment_code = $comment->getElementsByTagName('id')->item(0)->nodeValue;
		  				$commented_by = $comment->getElementsByTagName('author-name')->item(0)->nodeValue;
		  				$comment_date = Common::getFormattedDate($comment->getElementsByTagName('created-at')->item(0)->nodeValue);
		  				$comment_text = Common::br2n($comment->getElementsByTagName('body')->item(0)->nodeValue);
	
		  				$this->datos[$comment_date][$comment_code] = array(
		  					'lista' => 'Ver más',
		  					'event' => 'Comentario',
				  			'texto' => strip_tags($comment_text),
				  			'autor' => $commented_by,
				  			'label' => 'Publicado por',
				  			'color' => '#507082',
				  			'link'  => '/todo_items/'.$todo_code.'/comments#'.$comment_code
				  		);
	  				}
	  			}
	  		}
	  	}
	  }
	  krsort($this->datos);
  }

} // end class