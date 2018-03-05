<?php
	// Begin PHP session
	session_start();
	/*if(isset($_POST['adminid'])) {
		$_SESSION['adminid'] = $_POST['adminid'];
	}
	// Auto-redirect to management page if already logged in
	if(!isset($_SESSION['adminid'])) {
		header("Location: /index.php");
	}*/
?>
<html>
<head>
	<title>Graduation Eligibility</title>
	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/1c64219ae2.js"></script>
</head>
<body>
	<style>
		nav {
			position: fixed;
		}
		.navbar {
			margin-bottom: 0;
		}
		.hidden {
			position:absolute;
			top:-10000px;
		}
		.spinning {
			animation: spin 1s infinite linear;
			-webkit-animation: spin2 1s infinite linear;
		}
		#largeLogo {
			display: block;
			margin: auto;
			width: 40%;
		}
		@keyframes spin {
			from { transform: scale(1) rotate(0deg); }
			to { transform: scale(1) rotate(360deg); }
		}
		@-webkit-keyframes spin2 {
			from { -webkit-transform: rotate(0deg); }
			to { -webkit-transform: rotate(360deg); }
		}
		.indent {
			text-indent: 5%;
		}
	</style>
	<?php require_once 'nav.php' ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<br>
				<h1 style="text-align: center">Check Graduation Eligibility</h1>
				<hr>
				<form class="form-inline" id="frmIntro">
					<label class="sr-only" for="inlineFormInput">File Name</label>
					<input type="text" class="form-control col-md-10" id="inlineFormInput" placeholder="Input file">

					<button type="submit" class="btn btn-primary" style="margin-right: 1%; margin-left: 1%" id="btnUpload">Upload</button>
					<button class="btn btn-success" id="btnBegin">Begin</button>
					<br>
					<input type="file" class="hidden" name="fileUpload" id="fileUpload" accept=".xlsx">
				</form>
				<div class="row">
					<div class="col-md-12">
						<label for="output">Output</label>
						<textarea name="output" id="output" rows=6 class="form-control"></textarea>
					</div>
				</div>
				<hr>
				<h3>Completed Checks</h3>
				<br>
				<table class="table table-hover" id="tblProgrammes">
				</table>
			</div>
		</div>
	</div>
</body>
<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("#navCheck").addClass('active');
			
			$("#btnUpload").click(function(e) {
				e.preventDefault();
				$("#fileUpload").click();
			});
			$('#fileUpload').change(function() {
				$('#inlineFormInput').val($('#fileUpload').prop('files')[0].name);
			});
			$("#btnBegin").click(function(e) {
				e.preventDefault();
				$(this).html("<i class='fa fa-refresh spinning'></i> Checking");
				$(this).prop('disabled', true);
				
				e.preventDefault();
				var file = $('#fileUpload').prop('files')[0];
				var form_data = new FormData();
				
				form_data.append('file', imageFile);
				
				$.ajax({
				url: '/scripts/Check.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(data){
						response = JSON.parse(data); // gets response from the PHP script, if any

						if(response.success){
							$("#inlineFormInput").val("");
							$("#output").val(response.output);
							
							if(response.hasOwnProperty('filename')) {
								window.location = response.filename;
							}
						} else{
							$("#inlineFormInput")[0].setCustomValidity(response.message);
							$("#inlineFormInput")[0].reportValidity();
						}
					}
				});
			});
		});
	</script>
</html>
