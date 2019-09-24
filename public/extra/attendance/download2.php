<?php
							//download multiple.php
							if (isset($_GET['file'])) {
							//$file = $_GET['file'];// Always sanitize your submitted data!!!!!!
							//$file = filter_input(INPUT_GET, 'file', FILTER_SANITIZE_ENCODED);//works also
							$file = filter_input(INPUT_GET, 'file', FILTER_SANITIZE_SPECIAL_CHARS);
							$fileType = pathinfo($file);
							$returnType ;
							if (file_exists($file) && is_readable($file)) { 
							 
							switch ($fileType['extension']) {
							case "pdf" :
							$returnType = "Content-type: application/pdf";
							break;
							case "txt":
							$returnType ="Content-type: text/plain";
							break;
							case "html":
							$returnType ="Content-Type: text/html; charset=utf-8";
							break;
							case "htm":
							$returnType ="Content-Type: text/html; charset=utf-8";
							break;
							case "exe":
							$returnType ="Content-Type: application/octet-stream";
							break;  
							case "zip":
							$returnType = "Content-Type: application/zip";   
							break;
							case "jpg":
							$returnType ="Content-Type: image/jpeg'";
							break;
							case "jpeg":
							$returnType ="Content-Type: image/jpeg";
							break;
							case "gif":
							$returnType ="Content-Type: image/gif'";
							break;
							case "png":
							$returnType ="Content-Type: image/png";
							break;  
							case "ppt":
							$returnType ="Content-Type: application/vnd.ms-powerpoint";
							break;
							case "xls":
							$returnType ="Content-Type: application/vnd.ms-excel";
							break;
							case "xml":
							$returnType = "Content-Type: application/vnd.ms-xml ";        
							break;
							case "mpeg":
							$returnType ="Content-Type: audio/mpeg";
							break;
							case "swf":
							$returnType ="Content-Type: text/html; application/x-shockwave-flash";
							break;      
							}
							header($returnType);
							header('Content-Description: File Transfer');
							header($returnType);
							header("Content-Type: application/force-download");// some browsers need this
							header("Content-Disposition: attachment; filename=\"$file\"");
							header('Expires: 0');
							header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
							header('Pragma: public');
							header('Content-Length: ' . filesize($file));
							ob_clean();
							flush();
							readfile($file);
							exit;
							}else {
							header("HTTP/1.0 404 Not Found");
							echo "<h3>Error 404: File Not Found : <br /><em>$file</em></h3>";
							header('Refresh: 5; url=HR_Memo.php');
							print '<i style="color:red">You will be redirected in 5 seconds</i>';
							}
							}else {
							header('Refresh: 5; url=HR_Memo.php');
							print '<h1 style="text-align:center">You you shouldn\'t be here ......</h1><br> <p style="color:red"><b>redirection in 5 seconds</b></p>'; 
							}
							 
							?>