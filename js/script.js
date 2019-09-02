// JavaScript Document

function del_cookies(){
	Cookie.unset("del_ID");
	Cookie.unset("mod_ID");
}

/* 			Driver function starts here		 */
function drvModProf(){
	id = prompt("Enter Profile ID to Modify:");
	mod = confirm("Are you sure");
	if(mod == true){ Cookie.set("mod_ID", id); window.location = "drv_mod.php"}
	else{ window.location="drv_profile_mgt.php"; }
}
function drvDelProf(){
	id = prompt("Enter Profile ID to delete:");
	del	= confirm("Are you sure?");
	if(del == true){ Cookie.set("del_ID", id); window.location="drv_del.php";}
	else{ window.location="drv_profile_mgt.php"; }
}

/* 			Ambulance function starts here		 */
function ambModProf(){
	id = prompt("Enter Profile ID to Modify:");
	mod = confirm("Are you sure");
	if(mod == true){ Cookie.set("mod_ID", id); window.location = "amb_mod.php"}
	else{ window.location="amb_profile_mgt.php"; }
}
function ambDelProf(){
	id = prompt("Enter Profile ID to delete:");
	del	= confirm("Are you sure?");
	if(del == true){ Cookie.set("del_ID", id); window.location="amb_del.php";}
	else{ window.location="amb_profile_mgt.php"; }
}

/* 			Admin function starts here		 */
function admModProf(){
	id = prompt("Enter Profile ID to Modify:");
	mod = confirm("Are you sure");
	if(mod == true){ Cookie.set("mod_ID", id); window.location = "adm_mod.php"}
	else{ window.location="adm_profile_mgt.php"; }
}
function admDelProf(){
	id = prompt("Enter Profile ID to delete:");
	del	= confirm("Are you sure?");
	if(del == true){ Cookie.set("del_ID", id); window.location="adm_del.php";}
	else{ window.location="adm_profile_mgt.php"; }
}

