<?php
/**
 * @package		mod_show_member_list for Standard Squadron Site Project 
 * @subpackage	Helper Module - Obtains Member Records  
 * @copyright	Copyright (C) 2015 Joseph P. Gibson. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
//jimport('USPS.tableAccess');
jimport('usps.tableD5VHQAB');
jimport('usps.dbClients');
jimport('usps.includes.routines');
class mod_show_d5_roster
{
	static function getSquadronMemberData($squad_no = ''){
	//$vhqab = new USPSd5tableVHQAB();
	$squad_no = sprintf("%04d",$squad_no);
	//$list = $vhqab->getSquadronMembers($squad_no);
	$list = getMembersFromD5($squad_no);
	foreach ($list as $mbr){
		$certno = $vhqab->setMember($mbr);
		$member['mbr_name'] = $vhqab->getMemberNameAndRank($certno,false);
		$member['email']=$vhqab->getMemberEmail($certno);
		$member['telephone']=$vhqab->getMemberTelephone($certno);
		$member['cellphone']=$vhqab->getMemberCellphone($certno);
		$members[] = $member;
	}
	return $members;
	/*		
		$vhqab = new USPSd5tableVHQAB();
		$query = 'start_date >= curdate() and "squad_no='$squad_no'";
		$evts = $vhqab->events->search_records_in_order($query,'start_date'); 
		foreach($evts as &$evt){
			$evt['location'] = $vhqab->get_location_data($evt['location_id']);
			$evt['full_name'] = $vhqab->getMemberNameAndRank($evt['poc_id']);
		}	
		return $evts;
	*/	
	}
	static function getDistrictMemberData($distno = ''){
		$vhqab = new USPSd5tableVHQAB();
		$distno = sprintf("%02d",$distno);
		return $list = $vhqab->getDistrictMembers($distno);
		foreach ($list as $mbr){
			$certno = $vhqab->setMember($mbr);
			$member['mbr_name'] = $vhqab->getMemberNameAndRank($certno,false);
			$member['email']=$vhqab->getMemberEmail($certno);
			$member['telephone']=$vhqab->getMemberTelephone($certno);
			$member['cellphone']=$vhqab->getMemberCellphone($certno);
			$members[] = $member;
		}
		return $list;
	}
}
