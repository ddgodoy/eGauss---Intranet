<?php

require_once sfConfig::get('sf_root_dir').'/lib/vendor/new_basecamp/basecamp.php';

/**
 * New Bascamp functions
 */
class NewBasecamp
{
	/**
	 * Get array de proyectos
	 *
	 * @param boolean $add_empty
	 * @return array
	 */
	public static function todosLosProyectos($add_empty = false, $account = null)
	{
                $arrDatos = [];
		$arrDatos = $add_empty ? array('' => '-- Seleccionar --') : array();
		$basecamp = self::getBasecampInstance($account);
                if($basecamp)
                {    
                    $projects = $basecamp('GET', '/projects.json');

                    if (count($projects) > 0)
                    {
                            foreach ($projects as $item) { $id = ''.$item->id; $arrDatos[$id] = $item->name; }
                    }
                }    
		return $arrDatos;
	}
	
	/**
	 * Get resumen by proyecto
	 *
	 * @param integer $id_proyecto
	 * @return array
	 */
	public static function getResumenByProyecto($id_proyecto, $account= null)
	{
		$arDatos  = array();
		$basecamp = self::getBasecampInstance($account);
                if($basecamp){
                    //
                    $project = $basecamp('GET', '/projects/'.$id_proyecto.'.json');

                    $arDatos['prj_nombre']      = $project->name;
                    $arDatos['prj_descripcion'] = $project->description;

                    $pUrlName = str_replace(array('.',' '), '-', $arDatos['prj_nombre']);
                    $url_base = 'https://basecamp.com/'.sfConfig::get('app_bcamp_account').'/projects/'.$id_proyecto.'-'.$pUrlName;

                    $arDatos['head_accesos']    = array('cantidad' => $project->accesses->count, 'enlace' => $url_base.'/accesses');
                    $arDatos['head_mensajes']   = array('cantidad' => $project->topics->count, 'enlace' => $url_base.'/topics');
                    $arDatos['head_archivos']   = array('cantidad' => $project->attachments->count, 'enlace' => $url_base.'/attachments');
                    $arDatos['head_documentos'] = array('cantidad' => $project->documents->count, 'enlace' => $url_base.'/documents');
                    $arDatos['head_eventos']    = array('cantidad' => $project->calendar_events->count, 'enlace' => $url_base.'/calendar_events');
                    $arDatos['link_eventos']    = $url_base.'/events';

                    // --------------- todos ---------------
                    $count1    = 0;
                    $cantTodos = 0;
                    $listaTodo = array();
                    $todo_list = $basecamp('GET', '/projects/'.$id_proyecto.'/todolists.json');

                    if (count($todo_list) > 0)
                    {
                    foreach ($todo_list as $lista)
                    {
                            if ($count1 == 2) { break; }

                            $listaTodo[$lista->id]['nombre'] = $lista->name;
                            $listaTodo[$lista->id]['enlace'] = $url_base.'/todolists/'.$lista->id;

                            $count = 0;
                            $aTodo = array();
                            $todos = $basecamp('GET', '/projects/'.$id_proyecto.'/todolists/'.$lista->id.'.json');

                            foreach ($todos->todos->remaining as $todo)
                            {
                                    if ($count == 3) { break; }

                                    $aTodo[$todo->id]['nombre'] = $todo->content;
                                    $aTodo[$todo->id]['fecha']  = Common::getFormattedDate($todo->updated_at, 'd/m/Y H:i');
                                    $aTodo[$todo->id]['cant_c'] = $todo->comments_count;
                                    $aTodo[$todo->id]['asigne'] = !empty($todo->assignee->name)?$todo->assignee->name:'';;
                                    $aTodo[$todo->id]['enlace'] = $url_base.'/todos/'.$todo->id;
                                    $count++;
                            }
                            $listaTodo[$lista->id]['todos'] = $aTodo;
                            $cantTodos += $lista->remaining_count + $lista->completed_count;
                            $count1++;
                    }
                    }
                    $arDatos['head_todos'] = array('cantidad' => $cantTodos, 'enlace' => $url_base.'/todolists');
                    $arDatos['lista_todo'] = $listaTodo;

                    // --------------- eventos ---------------
                    $d_desde = 5;
                    $fec_hoy = date('Y-m-d');
                    $fec_sin = date('Y-m-d', strtotime("-$d_desde days", strtotime($fec_hoy)));

                    $count2  = 0;
                    $last_up = array();
                    $eventos = $basecamp('GET', '/projects/'.$id_proyecto.'/events.json?since='.$fec_sin);

                    if (count($eventos) > 0)
                    {
                    foreach ($eventos as $evento)
                    {
                            if ($count2 == 3) { break; }

                            $last_up[$evento->id]['action'] = strip_tags($evento->action);
                            $last_up[$evento->id]['target'] = $evento->target;
                            $last_up[$evento->id]['autor']  = $evento->creator->name;
                            $last_up[$evento->id]['hora']   = Common::getFormattedDate($evento->updated_at, 'd/m/Y H:i');
                            $last_up[$evento->id]['enlace'] = $evento->html_url;

                            $count2++;
                    }
                    }
                    $arDatos['last_updates'] = $last_up;

                    // --------------- mensajes ---------------
                    $count3 = 0;
                    $aTopic = array();
                    $topics = $basecamp('GET', '/projects/'.$id_proyecto.'/topics.json');

                    if (count($topics) > 0)
                    {
                    foreach ($topics as $topic)
                    {  		
                            if ($count3 == 5) { break; }

                            $tUrlName = str_replace(array('.',' '), '-', $topic->title);

                            $aTopic[$topic->id]['title']  = $topic->title;
                            $aTopic[$topic->id]['fecha']  = Common::getFormattedDate($topic->updated_at, 'd/m/Y H:i');
                            $aTopic[$topic->id]['autor']  = $topic->last_updater->name;
                            $aTopic[$topic->id]['enlace'] = $url_base.'/messages/'.$topic->topicable->id.'-'.$tUrlName;

                            $count3++;
                    }
                    }
                    $arDatos['last_topics'] = $aTopic;

                    // --------------- archivos ---------------
                    $count4 = 0;
                    $aFile = array();
                    $files = $basecamp('GET', '/projects/'.$id_proyecto.'/attachments.json');

                    if (count($files) > 0)
                    {
                    foreach ($files as $file)
                    {
                            if ($count4 == 3) { break; }

                            $aFile[$file->id]['name']   = $file->name;
                            $aFile[$file->id]['fecha']  = Common::getFormattedDate($file->created_at, 'd/m/Y H:i');
                            $aFile[$file->id]['autor']  = $file->creator->name;
                            $aFile[$file->id]['enlace'] = $file->url;

                            $count4++;
                    }
                    }
                    $arDatos['last_files'] = $aFile;

                    // --------------- documentos ---------------
                    $count5    = 0;
                    $aDocument = array();
                    $documents = $basecamp('GET', '/projects/'.$id_proyecto.'/documents.json');

                    if (count($documents) > 0)
                    {
                            foreach ($documents as $document)
                            {
                                    if ($count5 == 3) { break; }

                                    $aDocument[$document->id]['name']   = $document->title;
                                    $aDocument[$document->id]['fecha']  = Common::getFormattedDate($document->updated_at, 'd/m/Y H:i');
                                    $aDocument[$document->id]['enlace'] = $url_base.'/documents/'.$document->id;

                                    $count5++;
                            }
                    }
                    $arDatos['last_documents'] = $aDocument;
                    //
            }
            return $arDatos;
	}
	
	/**
	 * Return basecamp instance
	 *
	 * @return object
	 */
	public static function getBasecampInstance($account = null)
	{
           if($account){
		$basecamp = basecamp_api_client(
			sfConfig::get('app_bcamp_name'),
			sfConfig::get('app_bcamp_contact'),
			$account,
                        sfConfig::get('app_bcamp_username'),
                        sfConfig::get('app_bcamp_password')
                      );
                return $basecamp;
           }else{
               return false;
           }
	}

} // end class