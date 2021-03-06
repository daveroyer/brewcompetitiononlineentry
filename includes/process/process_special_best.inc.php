<?php 
/*
 * Module:      process_special_best_info.inc.php
 * Description: This module does all the heavy lifting for adding/editing info in the "special_best_info" table
 */
if ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] <= 1)) {
	
	if ($action == "add") {
		$insertSQL = sprintf("INSERT INTO $special_best_info_db_table (sbi_name, sbi_description, sbi_places, sbi_rank) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($_POST['sbi_name'], "text"),
						   GetSQLValueString($_POST['sbi_description'], "text"),
						   GetSQLValueString($_POST['sbi_places'], "int"),
						   GetSQLValueString($_POST['sbi_rank'], "int")
						   );
	
		
		mysqli_real_escape_string($connection,$insertSQL);
		$result = mysqli_query($connection,$insertSQL) or die (mysqli_error($connection));

		$pattern = array('\'', '"');
		$insertGoTo = str_replace($pattern, "", $insertGoTo); 
		header(sprintf("Location: %s", stripslashes($insertGoTo)));					   
	}
	
	if ($action == "edit") {
		$updateSQL = sprintf("UPDATE $special_best_info_db_table SET sbi_name=%s, sbi_description=%s, sbi_places=%s, sbi_rank=%s WHERE id=%s",
						   GetSQLValueString($_POST['sbi_name'], "text"),
						   GetSQLValueString($_POST['sbi_description'], "text"),
						   GetSQLValueString($_POST['sbi_places'], "int"),
						   GetSQLValueString($_POST['sbi_rank'], "int"),
						   GetSQLValueString($id, "int"));
	
		
		mysqli_real_escape_string($connection,$updateSQL);
		$result = mysqli_query($connection,$updateSQL) or die (mysqli_error($connection));
		
		$pattern = array('\'', '"');
		$updateGoTo = str_replace($pattern, "", $updateGoTo); 
		header(sprintf("Location: %s", stripslashes($updateGoTo)));					   
	}
	
} else echo "<p>Not available.</p>";
?>