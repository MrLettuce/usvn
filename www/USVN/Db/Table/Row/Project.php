<?php
/**
 * A rown into project table
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info/
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package USVN_Db
 * @subpackage Row
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id $
 */
class USVN_Db_Table_Row_Project extends USVN_Db_Table_Row
{
	/**
	* Add a group to a project
	*
	* @param mixed Group
	*/
	public function addGroup($group)
	{
		if (is_object($group)) {
			$group_id = $group->id;
		} elseif (is_numeric($group)) {
			$group_id = intval($group);
		}
		if ($this->id && $group_id) {
			$workgroups = new USVN_Db_Table_Workgroups();
			$workgroups->insert(
				array(
					"groups_id" 	=> $group_id,
					"projects_id"	=> $this->id,
				)
			);
		}
	}

	/**
	* Delete a group to a project
	*
	* @param mixed User
	*/
	public function deleteGroup($group)
	{
		if (is_object($group)) {
			$group_id = $group->id;
		} elseif (is_numeric($group)) {
			$group_id = intval($group);
		}
		if ($group_id) {
			$workgroups = new USVN_Db_Table_Workgroups();
			$where = $workgroups->getAdapter()->quoteInto('groups_id = ?', $group_id);
			$workgroups->delete($where);
		}
	}

	/**
	 * Delete all groups from workgroups
	 *
	 */
	public function deleteAllGroups()
	{
		$workgroups = new USVN_Db_Table_Workgroups();
		$workgroups->delete("");
	}

	/**
	* Check if an group is in the project
	*
	* @param USVN_Db_Table_Row_Group Group
	* @return boolean
	*/
	public function groupIsMember($group)
	{
		$workgroups = new USVN_Db_Table_Workgroups();
		$res = $workgroups->fetchRow(
			array(
				"groups_id" 	=> $group->id,
				"projects_id"	=> $this->id,
			)
		);
		if ($res === NULL) {
			return false;
		}
		return true;
	}
}