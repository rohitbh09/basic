<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script>
	function _(el){
		return document.getElementById(el);
	}
	function uploadFile(){

		var file = _("uploadFileInp").files[0];

		if( typeof file == "undefined" ){

			_("status").innerHTML = "Please Select file";
			return false;
		}
		// alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("uploadFileInp", file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "file_upload.php");
		ajax.send(formdata);
	}
	function progressHandler(event){
		_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
	}
	function completeHandler(event){
		_("status").innerHTML = event.target.responseText;
		_("progressBar").value = 0;
	}
	function errorHandler(event){
		_("status").innerHTML = "Upload Failed";
	}
	function abortHandler(event){
		_("status").innerHTML = "Upload Aborted";
	}
</script>
</head>
<body>
<div class="upload-box">
	<form id="upload_form" enctype="multipart/form-data" method="post">
		<div class="lb-header">
      <a href="#" class="active">Upload File</a>
    </div>
		<div class="u-form-group">
       <input type="file" name="uploadFileInp" id="uploadFileInp"><br>
    </div>
    <div class="u-form-group">
	  	<input type="button" value="Upload File" onclick="uploadFile()">
    </div>
    <div class="u-form-group">
	  	<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
	  </div>
	  <div class="u-form-group">
	  	<h3 id="status"></h3>
	  </div>
	  <div class="u-form-group">
	  	<p id="loaded_n_total"></p>
	  </div>
	</form>
</div>
</body>
</html>
