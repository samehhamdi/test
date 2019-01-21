<?php
	include("globalInclude.php");
	include("common_form_lang.php");
	include("common_data.inc.php");
	include("intranet.inc.php");
	include("attach_lang.inc.php");
	include("lookup.inc.php");
	
	$thisKenUser = new Org_KenUser();
	$thisKenUser->fetchFromCookie(true);

	if ($user = $thisKenUser->getUserArray()) {
		// Someone is logged in.
		$fcrfirst_name = $user[first_name];
		$fcrlast_name = $user[last_name];
		$fcrlogonid = $user[person_id];
		$ld = $user[ld];
		$language = $user[language];
		$is_global_prod_man = $user[is_global_prod_man];
		$primary_group = $user[primary_group];
		$stylesheet = $user[stylesheet];
		$screen_width = $user[screen_width];
	} else {
		// No one is logged in
		die("Login failed - please contact intranet@uk.linedata.com");
	}
	
	if ($is_global_prod_man == "N" AND $fcrlogonid != "3" AND $fcrlogonid != "515") {
		die ("Insufficient Access Rights for this area of the Intranet - Contact the System Administrator to gain access");
	}

	$con = DBConnection::getInstance(new DSN("kenuser"));
	$con->openConnection();

	html_head("X", $stylesheet, "GPM");
	lang_body_start();

	banner_display_corporate($language, "X", "Global Product Management", $primary_group, $stylesheet);
	menu_start_lang();
	menu_end_lang();
?>

<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1">
	<TR>
		<TD VALIGN="top" ALIGN=center WIDTH=8></TD>
		<TD COLSPAN="8"><BR></TD>
	</TR>
	<TR>
		<TD VALIGN="top" ALIGN=center WIDTH=8></TD>
		<TD ID="mainhead" VALIGN="top" ALIGN=left COLSPAN="4">&nbsp;Access to this page is restricted to the following individuals</TD>
	</TR>
	<TR>
		<TD VALIGN="top" ALIGN=center WIDTH=8></TD>
		<TD ID="subhead" VALIGN="top" ALIGN=center>Paris</TD>
		<TD ID="subhead" VALIGN="top" ALIGN=center>Boston</TD>
		<TD ID="subhead" VALIGN="top" ALIGN=center>Luxembourg</TD>
		<TD ID="subhead" VALIGN="top" ALIGN=center>UK</TD>
		<TD VALIGN="top" ALIGN=center WIDTH=8></TD>
	<TR>
		<TD VALIGN="top" ALIGN=center WIDTH=8></TD>
		<TD CLASS="fields" VALIGN=top ALIGN=left>
<?php
			$sql = "SELECT 
						known_as, 
						last_name 
					FROM 
						id_person, 
						id_internal 
					WHERE 
						id_person.custid IN (1614,1061,1938) 
						AND 
						id_person.person_id = id_internal.person_id 
						AND 
						id_person.active = 'Y' 
						AND 
						id_internal.is_global_prod_man = 'Y' 
					ORDER BY 
						known_as, 
						last_name";
			$con->execSelect($sql) or die ("Failed to read error log details");
			$rs = new RecordSet($con);
			while ($baps = $rs->nextItem()) {
				echo $baps["known_as"] . " " . $baps["last_name"] . "<BR>";
			}
			?>
		</TD>
		<TD CLASS="fields" VALIGN=top ALIGN=left>
			<?php
			$sql = "SELECT 
						known_as, 
						last_name 
					FROM 
						id_person, 
						id_internal 
					WHERE 
						id_person.addrid IN ('3391','4089') 
						AND 
						id_person.person_id = id_internal.person_id 
						AND 
						id_person.active = 'Y' 
						AND 
						id_internal.is_global_prod_man = 'Y' 
					ORDER BY 
						known_as, 
						last_name";
			$con->execSelect($sql) or die ("Failed to read error log details");
			$rs = new RecordSet($con);
			while ($baps = $rs->nextItem()) {
				echo $baps["known_as"] . " " . $baps["last_name"] . "<BR>";
			}
			?>
		</TD>
		<TD CLASS="fields" VALIGN=top ALIGN=left>
			<?php
			$sql = "SELECT 
						known_as, 
						last_name 
					FROM 
						id_person, 
						id_internal 
					WHERE 
						id_person.addrid = '4050' 
						AND 
						id_person.person_id = id_internal.person_id 
						AND 
						id_person.active = 'Y' 
						AND 
						id_internal.is_global_prod_man = 'Y' 
					ORDER BY 
						known_as, 
						last_name";
			$con->execSelect($sql) or die ("Failed to read error log details");
			$rs = new RecordSet($con);
			while ($baps = $rs->nextItem()) {
				echo $baps["known_as"] . " " . $baps["last_name"] . "<BR>";
			}
			?>
		</TD>
		<TD CLASS="fields" VALIGN=top ALIGN=left>
			<?php
			$sql = "SELECT 
						known_as, 
						last_name 
					FROM 
						id_person, 
						id_internal 
					WHERE 
						id_person.addrid IN ('3394','3345') 
						AND 
						id_person.person_id = id_internal.person_id 
						AND 
						id_person.active = 'Y' 
						AND 
						id_internal.is_global_prod_man = 'Y' 
					ORDER BY 
						known_as, 
						last_name";
			$con->execSelect($sql) or die ("Failed to read error log details");
			$rs = new RecordSet($con);
			while ($baps = $rs->nextItem()) {
				echo $baps["known_as"] . " " . $baps["last_name"] . "<BR>";
			}
			?>
		</TD>
	</TR>

	<?php 
	attachDisplayGPM($language,"gpm","gpm", "Click here to view this link", "Click here to delete this link"); 
	?>
</TABLE>
<TABLE WIDTH=170>
<TR>
	<TD WIDTH=100% ALIGN=center><BR><BR>
		<A CLASS=fields HREF="docsection.php?action=Add&facility=gpm"><IMG SRC="/images/icon_folder.gif" ALT="" BORDER=0><BR>
		Add New Folder</A>
	</TD>
</TR>
</TABLE>

</BODY>
</HTML>
