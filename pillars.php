<?php
	require_once "globals.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_NAME; ?> - Manage Modules</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/common.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
	<style>
		html, body {
			margin: 0;
			height: 100%;
			overflow: hidden
		}
		.row.main-content {
			height: 100%;
		}

		.scrollable {
			overflow-y: auto !important;
			overflow-x: auto;
			height: 85vh;
		}
		.center {
			margin: auto;
		}
		.detailList > tr > td {
			font-size: x-large;
		}
		.accordion-item {
			border: none !important;
		}
		.accordion-header {
			border: 1px solid;
			border-color: #AAAAAA;
			border-radius: calc(.25rem - 1px);
			line-height: 1.5;
			background-color: #f7f7f9;
			padding: .75rem 1.25rem;
		}
		.accordion-sublist {
			border: 1px solid;
			border-color: #CCCCCC;
			border-radius: calc(.25rem - 1px);
			line-height: 1.5;
			background-color: #f7f7f9;
			padding: .75rem 1.25rem;
		}
		.table > thead, .table > thead > tr > th {
			border: 0 !important;
		}
	</style>
	<?php require_once 'nav.php' ?>
	<div class="container-fluid" style="margin-top: 2vh;">
		<div class="row">
			<span style="font-size: 5em; margin-left: 2vh;" id="pillarName"></span>
		</div>
	</div>
	<!-- UI element for top selector (Details, Stats, Attendees) -->
	<ul class="nav nav-pills" style="margin-top: 2vh; margin-left: 2vh;">
		<li class="nav-item"><a href="#" class="nav-link" id="tabProperties">Properties</a></li>
		<li class="nav-item"><a href="#" class="nav-link active" id="tabTracks">Tracks</a></li>
	</ul>
	<div class="container-fluid" style="margin-top: 2vh">
		<div id="paneProperties" class="row main-content">
			
		</div>
		<div id="paneTracks" class="row main-content">
			<!-- Create side pane with events -->
			<div class="col-md-4 col-xs-4">
				<div class="scrollable">
					<table class="table table-hover" id="tblTracks">
						<thead><a href="#" id="btnAddTrack" style="font-size: large;"><i class="fa fa-plus"></i> Add Track</a></thead>
						<tbody class="detailList" id="detailTracks">
						</tbody>
					</table>
				</div>
			</div>
			<!-- Begin main detail view -->
			<div class="col-md-8 col-xs-8 scrollable" style="border-left: 1px solid #CCCCCC;">
				<div id="mainContentTracks" style="margin-top: 2vh">
					<h3>Core Modules <span class="float-md-right"><button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Core</button></span></h3>
					<br>
					<table class="table table-hover">
						<colgroup>
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 20%;">
							<col span="1" style="width: 70%;">
							<col span="1" style="width: 5%;">
						</colgroup>
						<thead>
							<tr>
								<th>#</th>
								<th>Module Code</th>
								<th>Module Name</th>
								<th><i class="fa fa-times"></i></th>
							</tr>
						</thead>
						<tbody class="tblTrackCore"></tbody>
					</table>
					<br>
					<h3>Elective Modules <span class="float-md-right"><button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Elective</button></span></h3>
					<br>
					<div class="row">
						<div class="col-md-1">
							<input type="number" class="form-control" id="txtElectives" name="txtElectives">
						</div>
						<div class="col-md-11">
							of the following electives is required
						</div>
					</div>
					<table class="table table-hover">
						<colgroup>
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 20%;">
							<col span="1" style="width: 70%;">
							<col span="1" style="width: 5%;">
						</colgroup>
						<thead>
							<tr>
								<th>#</th>
								<th>Module Code</th>
								<th>Module Name</th>
								<th><i class="fa fa-times"></i></th>
							</tr>
						</thead>
						<tbody class="tblTrackElectives"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlAddModule">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add module</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table style="border: 0">
						<tr>
							<td><label for="txtModuleCode" class="control-label mb-2 mr-sm-2 mb-sm-0">Module Code:</label></td>
							<td><input type="text" class="form-control" name="txtModuleCode" id="txtModuleCode" placeholder="XX.XXX" /></td>
						</tr>
						<tr>
							<td><label for="txtModuleName" class="control-label mb-2 mr-sm-2 mb-sm-0">Module Name:</label></td>
							<td><input type="text" class="form-control" name="txtModuleName" id="txtModuleName" /></td>
						</tr>
						<tr>
							<td><label for="txtRequiredGrades" class="control-label mb-2 mr-sm-2 mb-sm-0">Required Grades:</label></td>
							<td><input type="text" class="form-control" name="txtRequiredGrades" id="txtRequiredGrades" value="A,B,C,D" /></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnAddModuleSave">Add</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlAddTrack">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Track</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							Track Name: 
						</div>
						<div class="col-md-9">
							<input class="form-control" type="text" name="txtAddTrackName" id="txtAddTrackName">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnAddTrackConfirm">Add</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlDeleteTrackCore">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Core</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this core module?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteTrackCoreConfirm">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var selected = -1;
		
		var pillar = "<?php echo $_GET['pillar']; ?>";
		function select(trackId) {
			if(selected != -1) {
				$("#" + selected).removeClass('bg-info');
			}
			selected = trackId;
			$("#" + trackId).addClass('bg-info');
			loadTrack(trackId);
		}
		
		function loadTracks() {
			$.get("scripts/GetTracks.php?pillar=" + pillar, function(data) {
				var response = JSON.parse(data); // Parse the response from JSON
				
				if(response.success) {
					var detailTracks = "";
					for(var i = 0; i < response.tracks.length; i++) {
						detailTracks += "<tr><td>" + response.tracks[i].name + "</td></tr>";
					}
					
					$("#detailTracks").html(detailTracks);
					console.log(detailTracks);
					if(response.tracks.length > 0) {
						select(response.tracks[0].id);
					}
					
					$("#detailList > tr > td").click(function() {
						var trackId = $(this).attr('id');
						
						select(trackId);
					});
					$(".delete-track-core").click(function(e) {
						e.preventDefault();
						//deleteList = $(this).attr('id');
						$("#mdlDeleteTrackCore").modal();
					});
					$("#btnDeleteTrackCoreConfirm").unbind().click(function() {
						/*$.post("scripts/DeleteList.php", { listId: deleteList }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlDeleteList").modal('hide');
								loadLists();
							}
						});*/
					});
				}
			});
		}
		
		$(document).ready(function() {
			$("#navPillars").addClass("active");
			loadTracks();
			
			$("#tabTracks").click(function(e) {
				e.preventDefault();
				
				$("#paneTracks").show();
				$("#paneProperties").hide();
				
				$("#tabTracks").addClass("active");
				$("#tabProperties").removeClass("active");
			});
			$("#tabProperties").click(function(e) {
				e.preventDefault();
				
				$("#paneTracks").hide();
				$("#paneProperties").show();
				
				$("#tabTracks").removeClass("active");
				$("#tabProperties").addClass("active");
			});
			
			$("#tabTracks").click();
			
			$("#btnAddTrack").click(function() {
				$("#mdlAddTrack").modal();
			});
			$("#btnAddTrackConfirm").click(function() {
				var name = $("#txtAddTrackName").val();
				if(!name || name.length == 0) {
					$("#txtAddTrackName")[0].setCustomValidity("Please enter a track name");
		                	$("#txtAddTrackName")[0].reportValidity();
					
					return;
				}
				$.post("scripts/AddTrack.php", { name: name, pillar: pillar }, function(resultData) {
					var resultObject = JSON.parse(resultData);
						
					if(resultObject.success) {
						$("#mdlAddTrack").modal('hide');
						loadTracks();
					}
				});
			});
			
			$("#pillarName").html(pillar);
		});
	</script>
</body>
