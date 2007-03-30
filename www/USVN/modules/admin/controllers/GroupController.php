<?php
/**
 * Group management controller's.
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package admin
 * @subpackage group
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id$
 */

require_once 'USVN/modules/admin/controllers/IndexController.php';

class admin_GroupController extends admin_IndexController
{
	public function indexAction()
    {
    	$table = new USVN_Db_Table_Groups();
		$this->_view->groups = $table->fetchAll(null, "groups_name");
		$this->_render('index.html');
    }

	public function newAction()
	{
		if (!empty($_POST)) {
			$this->save("USVN_Db_Table_Groups", "group");
		}
		$this->_render('form.html');
	}

	public function editAction()
	{
		if (!empty($_POST)) {
			$this->save("USVN_Db_Table_Groups", "group");
		} else {
			$groupTable = new USVN_Db_Table_Groups();
			$this->_view->group = $groupTable->fetchRow(array('groups_id = ?' => $this->getRequest()->getParam('id')));
		}
		$this->_render('form.html');
	}

	public function deleteAction()
	{
		if (!empty($_POST)) {
			$this->delete("USVN_Db_Table_Groups", "group");
		} else {
			$groupTable = new USVN_Db_Table_Groups();
			$this->_view->group = $groupTable->fetchRow(array('groups_id = ?' => $this->getRequest()->getParam('id')));
		}
		$this->_render('form.html');
	}

	public function noRouteAction()
    {
        $this->_redirect('/');
    }
}