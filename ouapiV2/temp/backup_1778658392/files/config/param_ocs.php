<?php
			
	// Tables OCS utilisées
	define("TAB_OCS_HARD","hardware");
	define("TAB_OCS_BIOS","bios");
	define("TAB_OCS_SOFT","softwares");
	define("TAB_OCS_INPUT","inputs");
	define("TAB_OCS_MONITOR","monitors");
	define("TAB_OCS_MODEM","modems");
	define("TAB_OCS_PRINTER","printers");
	define("TAB_OCS_DRIVES","drives");
	define("TAB_OCS_CONFIG","config");

	// Champs OCS
	// HARDWARE
	define("COL_OCS_HARD_ID","ID");
	define("COL_OCS_HARD_NAME","NAME");
	define("COL_OCS_DOMAIN","USERDOMAIN");
	define("COL_OCS_IPADDR","IPADDR");
	define("COL_OCS_USERID","USERID");
	define("COL_OCS_WORKG","WORKGROUP");
	define("COL_OCS_PROCESST","PROCESSORT");
	define("COL_OCS_PROCESSS","PROCESSORS");
	define("COL_OCS_PROCESSN","PROCESSORN");
	define("COL_OCS_MEMORY","MEMORY");
	define("COL_OCS_SWAP","SWAP");
	define("COL_OCS_WINOWNER","WINOWNER");
	define("COL_OCS_WINCOMPANY","WINCOMPANY");
	define("COL_OCS_OSNAME","OSNAME");
	define("COL_OCS_OSVERSION","OSVERSION");
	define("COL_OCS_OSSP","OSCOMMENTS");
	define("COL_OCS_LASTDATE","LASTDATE");
	
	// BIOS
	define("COL_OCS_BIOS_HARDID","HARDWARE_ID");
	define("COL_OCS_BIOS_SNUM","SSN");
	define("COL_OCS_BIOS_MARQUE","SMANUFACTURER");
	define("COL_OCS_BIOS_MODELE","SMODEL");
	define("COL_OCS_BIOS_TYPE","TYPE");
	

	// SOFTWARE
	define("COL_OCS_SOFT_ID","ID");
	define("COL_OCS_SOFT_VERSION","VERSION");
	define("COL_OCS_SOFT_NAME","NAME");
	define("COL_OCS_SOFT_PUBLISHER","PUBLISHER");
	define("COL_OCS_SOFT_HARDID","HARDWARE_ID");
	
	// Monitors
	define("COL_OCS_MON_ID","ID");
	define("COL_OCS_MON_HARDID","HARDWARE_ID");
	define("COL_OCS_MON_MARQUE","MANUFACTURER");
	define("COL_OCS_MON_NAME","CAPTION");
	define("COL_OCS_MON_DESC","DESCRIPTION");
	define("COL_OCS_MON_TYPE","TYPE");
	define("COL_OCS_MON_SERIAL","SERIAL");
	
	// Modems
	define("COL_OCS_MODEM_ID","ID");
	define("COL_OCS_MODEM_HARDID","HARDWARE_ID");
	define("COL_OCS_MODEM_NAME","NAME");
	define("COL_OCS_MODEM_MODELE","MODEL");
	define("COL_OCS_MODEM_DESC","DESCRIPTION");
	define("COL_OCS_MODEM_TYPE","TYPE");

	// Inputs
	define("COL_OCS_IPT_ID","ID");
	define("COL_OCS_IPT_HARDID","HARDWARE_ID");
	define("COL_OCS_IPT_TYPE","TYPE");
	define("COL_OCS_IPT_MARQUE","MANUFACTURER");
	define("COL_OCS_IPT_NAME","CAPTION");
	define("COL_OCS_IPT_DESC","DESCRIPTION");
	define("COL_OCS_IPT_INTERFACE","INTERFACE");
	define("COL_OCS_IPT_POINTTYPE","POINTTYPE");
	
	// Printers
	define("COL_OCS_LPT_ID","ID");
	define("COL_OCS_LPT_HARDID","HARDWARE_ID");
	define("COL_OCS_LPT_NAME","NAME");
	define("COL_OCS_LPT_DRIVER","DRIVER");
	define("COL_OCS_LPT_PORT","PORT");
	define("COL_OCS_LPT_DESC","DESCRIPTION");
	
	// Drives
	define("COL_OCS_DRV_ID","ID");
	define("COL_OCS_DRV_HARDID","HARDWARE_ID");
	define("COL_OCS_DRV_LETTER","LETTER");
	define("COL_OCS_DRV_TYPE","TYPE");
	define("COL_OCS_DRV_FILESYSTEM","FILESYSTEM");
	define("COL_OCS_DRV_TOTAL","TOTAL");
	define("COL_OCS_DRV_FREE","FREE");
	define("COL_OCS_DRV_NUMFILES","NUMFILES");
	define("COL_OCS_DRV_VOLUMN","VOLUMN");
	define("COL_OCS_DRV_CREATEDATE","CREATEDATE");
	
	// Config
	define("COL_OCS_CNF_NAME","NAME");
	define("COL_OCS_CNF_IVALUE","IVALUE");
	define("COL_OCS_CNF_TVALUE","TVALUE");
	define("COL_OCS_CNF_COMMENTS","COMMENTS");
	
	?>