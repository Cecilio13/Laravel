<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form Generator</title>
  <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
  <script src="js/FileSaver.js"></script>
  <script src="js/html-docx.js"></script>
</head>
<body>
	<?php
	if(isset($_POST['DownloadDocx'])){
		$DocxFormType=$_POST['DocxFormType'];
		$companyname=$_POST['companyname'];
		$departmentname=$_POST['departmentname'];
		$DocxEmployee=$_POST['DocxEmployee'];
		$DocxReason=$_POST['DocxReason'];
		$content=$_POST['FormContent'];
		$content=str_replace("{COMPANY}",$companyname,$content);
		$content=str_replace("{REASON}",$DocxReason,$content);
		$content=str_replace("{DEPARTMENT}",$departmentname,$content);
		$content=str_replace("{EMPLOYEE}",$DocxEmployee,$content);
		
	}
	
	?>
  
  <textarea id="content" cols="60" rows="10" style="display:none;">
	<?php
	echo $content;
	?>
  </textarea>
  <div class="page-orientation" style="display:none;">
    <span>Page orientation:</span>
    <label><input type="radio" name="orientation" value="portrait" checked>Portrait</label>
    <label><input type="radio" name="orientation" value="landscape">Landscape</label>
  </div>
  <div style="display:none;">
  <button id="convert">Convert</button>
  <div id="download-area"></div>
  </div>
  <script>
    tinymce.init({
      selector: '#content',
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen fullpage",
        "insertdatetime media table contextmenu paste"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | " +
        "alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | " +
        "link image"
    });
    document.getElementById('convert').addEventListener('click', function(e) {
      e.preventDefault();
      convertImagesToBase64()
      // for demo purposes only we are using below workaround with getDoc() and manual
      // HTML string preparation instead of simple calling the .getContent(). Becasue
      // .getContent() returns HTML string of the original document and not a modified
      // one whereas getDoc() returns realtime document - exactly what we need.
      var contentDocument = tinymce.get('content').getDoc();
      var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
      var orientation = document.querySelector('.page-orientation input:checked').value;
      var converted = htmlDocx.asBlob(content, {orientation: orientation});

      saveAs(converted, 'test.docx');

      var link = document.createElement('a');
      link.href = URL.createObjectURL(converted);
      link.download = 'document.docx';
      link.appendChild(
        document.createTextNode('Click here if your download has not started automatically'));
      var downloadArea = document.getElementById('download-area');
      downloadArea.innerHTML = '';
      downloadArea.appendChild(link);
    });

    function convertImagesToBase64 () {
      contentDocument = tinymce.get('content').getDoc();
      var regularImages = contentDocument.querySelectorAll("img");
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d');
      [].forEach.call(regularImages, function (imgElement) {
        // preparing canvas for drawing
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        canvas.width = imgElement.width;
        canvas.height = imgElement.height;

        ctx.drawImage(imgElement, 0, 0);
        // by default toDataURL() produces png image, but you can also export to jpeg
        // checkout function's documentation for more details
        var dataURL = canvas.toDataURL();
        imgElement.setAttribute('src', dataURL);
      })
      canvas.remove();
    }
	
	window.onload = function(e){ 
		  e.preventDefault();
		  convertImagesToBase64()
		  // for demo purposes only we are using below workaround with getDoc() and manual
		  // HTML string preparation instead of simple calling the .getContent(). Becasue
		  // .getContent() returns HTML string of the original document and not a modified
		  // one whereas getDoc() returns realtime document - exactly what we need.
		  var contentDocument = tinymce.get('content').getDoc();
		  var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
		  var orientation = document.querySelector('.page-orientation input:checked').value;
		  var converted = htmlDocx.asBlob(content, {orientation: orientation});

		  saveAs(converted, 'test.docx');

		  var link = document.createElement('a');
		  link.href = URL.createObjectURL(converted);
		  link.download = 'document.docx';
		  link.appendChild(
			document.createTextNode('Click here if your download has not started automatically'));
		  var downloadArea = document.getElementById('download-area');
		  downloadArea.innerHTML = '';
		  downloadArea.appendChild(link);
		  window.location.replace('../../form_generator');
	}
	
	
	
	
  </script>
</body>
</html>
