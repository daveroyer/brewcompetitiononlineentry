<?php if ($action == "html") { ?>
<p class="lead">If you want to upload mutiple files at once, use the <a href="<?php echo $base_url; ?>index.php?section=admin&amp;go=upload_scoresheets">enhanced file upload function</a>.</p>
<p class="lead">For entrants to be able to view their scoresheets, each PDF should:
	<ol>
    	<li>Contain all judge scoresheets and other documentation (cover sheet, etc.) in a single file.</li>
        <li>Be named with the judging number only (e.g., 123456.pdf).</li>
        <li>Have a .pdf or .PDF extension.</li>
    </ol>
</p>
<form method="post" action="<?php echo $base_url; ?>handle.php?action=html_docs" ENCTYPE="multipart/form-data">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <span class="btn btn-default btn-file"><span>Choose PDF File</span><input type="file" name="file" /></span>
    <span class="fileinput-filename text-success"></span> <span class="fileinput-new text-danger">No file chosen...</span>
</div>
	<p><input type="submit" class="btn btn-primary" value="Upload PDF File"></p>
</form>
<?php } else { ?>
<p class="lead">The <a href="<?php echo $base_url; ?>index.php?section=admin&amp;go=upload_scoresheets&amp;action=html">single file upload function</a> is also available as an alternative to this multiple upload function.</p>
<p class="lead">For entrants to be able to view their scoresheets, each PDF should:
	<ol>
    	<li>Contain all judge scoresheets and other documentation (cover sheet, etc.) in a single file.</li>
        <li>Be named with the judging number only (e.g., 123456.pdf).</li>
        <li>Have a .pdf or .PDF extension.</li>
    </ol>
</p>
<form id="upload-widget" method="post" action="<?php echo $base_url; ?>handle.php?action=docs" class="dropzone">
<div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>
<?php } ?>
<script type="text/javascript" language="javascript">
	 $(document).ready(function() {
		$('#sortable').dataTable( {
			"bPaginate" : true,
			"sPaginationType" : "full_numbers",
			"bLengthChange" : false,
			"iDisplayLength" :  <?php echo round($_SESSION['prefsRecordPaging']); ?>,
			"sDom": 'tp',
			"bStateSave" : false,
			"aaSorting": [[0,'asc']],
			"bProcessing" : true,
			"aoColumns": [
				null,
				null,
				{ "asSorting": [  ] }
				]
			} );
		} );
			
		$("a.user_images").fancybox(
			{
			nextClick   : true,
			nextEffect  : 'elastic',
			prevEffect  : 'elastic',
			padding     : 20,
			helpers:  {
					title : {
						type : 'inside'
					},
					overlay : {
						showEarly : false
					}
				}
			}
			
		);
	</script>
<?php 
$upload_dir = (USER_DOCS);
if (!is_dir_empty($upload_dir)) {
	
	// List Files in the directory
	$handle = opendir($upload_dir);
	$filelist = "<h2>Files in the Directory</h2>";
	$filelist .= "<table class=\"table table-bordered table-responsive table-striped\" id=\"sortable\">\n";
	$filelist .= "<thead>\n";
	$filelist .= "<tr>\n";
	$filelist .= "<th>File Name</th>\n";
	$filelist .= "<th>Date/Time Uploaded</th>\n";
	$filelist .= "<th>Actions</th>\n";
	$filelist .= "</thead>\n";
	$filelist .= "<tbody>\n";
	while ($file = readdir($handle)) {
	   if(!is_dir($file) && !is_link($file)) {
			$filelist .= "<tr>\n";
			$filelist .= "<td><a id=\"modal_window_link\" class=\"user_images\" href=\"".$base_url."user_docs/$file\" title=\"".$file."\" >".$file."</a></td>\n";
			$filelist .= "<td>".date("l, F j, Y H:i", filemtime($upload_dir.$file))."</td>\n";
			$filelist .= "<td><a href=\"".$base_url."includes/process.inc.php?action=delete&amp;go=doc&amp;filter=".$file."&amp;view=".$action."\" data-confirm=\"Are you sure? This will remove the file named ".$file." from the server.\"><span class=\"fa fa-lg fa-trash\"></span></a></td>\n";
			$filelist .= "</tr>\n";
	   }
	}
	$filelist .= "</tbody>\n";
	$filelist .= "</table>\n";
	echo $filelist;

}

?>

