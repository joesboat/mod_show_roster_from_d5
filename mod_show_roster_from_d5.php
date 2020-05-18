<?php
/**
 * @package		mod_show_member_list for Standard Squadron Site Project 
 * @subpackage	Main mod_show_event_list Module 
 * @copyright	Copyright (C) 2015 Joseph P. Gibson. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('usps.table_squadrons');
jimport('usps.tableD5VHQAB');
jimport('usps.includes.routines');
jimport('usps.dbClients');
include (JPATH_LIBRARIES.'/USPSaccess/dbUSPS.php');
require_once dirname(__FILE__).'/helper.php';
$session = JFactory::getSession();
//$params = $app->getParams();
$debug = $params->get("siteLog");
$source = $params->get('roster_type');
$vhqab = new USPSd5tableVHQAB();
$fields = "certificate,last_name,first_name,grade,rank,email,telephone,cell_phone,nickname,nn_prf";
if ($source == '4785'){
	$squad_name = "Rockville Sail & Power Squadron";
	$heading = "$squad_name Members";
	$list = getMembersFromD5($source);
}elseif ($source == 'sqd'){
	$sqds = new table_squadrons($db_d5,'');
	$user = JFactory::getUser();
	$certno = $user->username;
	//$vhqab = new USPSd5tableVHQAB();
	$squad_no = sprintf("%04d",$vhqab->getSquadNumber($certno));
	$squad_name = $sqds->getSquadronName($squad_no);
	$heading = "$squad_name Members";
	//$list = $vhqab->getLinkToSquadronMembers($squad_no, $fields);
	$list = getMembersFromD5($squad_no);
}
// Include the syndicate functions only once	$vhqab = new USPSd5tableVHQAB();
$params->def('greeting', 1);
require JModuleHelper::getLayoutPath('mod_show_roster_from_d5', $params->get('layout', 'default'));
