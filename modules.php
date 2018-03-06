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
	<!-- UI element for top selector (Details, Stats, Attendees) -->
	<ul class="nav nav-tabs" style="margin-top: 2vh; margin-left: 2vh;">
		<li class="nav-item"><a href="#" class="nav-link" id="tabModules">Modules</a></li>
		<li class="nav-item"><a href="#" class="nav-link" id="tabModuleLists">Lists</a></li>
	</ul>
	<div class="container-fluid">
		<div id="paneModules">
			<div class="row" style="margin-top: 2vh;">
				<div class="col-md-10">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control" placeholder="Module code, Module name..." aria-describedby="basic-addon1" id="txtModulesSearch" onkeyup="filterModules()">
					</div>
				</div>
				<div class="col-md-2">
					<button class="btn btn-primary float-right" id="btnAddModule"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Module</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<colgroup>
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 20%;">
							<col span="1" style="width: 50%;">
							<col span="1" style="width: 15%;">
							<col span="1" style="width: 5%;">
							<col span="1" style="width: 5%;">
						</colgroup>
						<thead><tr><th>#</th><th>Module Code</th><th>Module Name</th><th>Required Grades</th><th><i class="fa fa-pencil"></i></th><th><i class="fa fa-times"></i></th></tr></thead>
						<tbody id="tblModules">
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="paneModuleLists" class="row main-content">
			<!-- Create side pane with events -->
			<div class="col-md-4 col-xs-4">
				<div class="scrollable">
					<table class="table table-hover" id="tblLists">
						<thead><th>Lists</th></thead>
						<tbody class="detailList" id="detailList">
						</tbody>
					</table>
				</div>
			</div>
			<!-- Begin main detail view -->
			<div class="col-md-8 col-xs-8 scrollable" style="border-left: 1px solid #CCCCCC;">
				<div id="mainContent">
					<table class="table table-hover">
						<thead><tr><th>#</th><th>Module</th><th>Required Grades</th><th><i class="fa fa-pencil"></i></th><th><i class="fa fa-times"></i></th></tr></thead>
						<tbody id="tblListModules">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlAddModuleList">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add module list</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-inline">
							<label for="txtModuleListName" class="control-label mb-2 mr-sm-2 mb-sm-0">List name:</label>
							<input type="text" class="form-control" name="txtModuleListName" id="txtModuleListName" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnAddModuleListSave">Add</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlEditModuleList">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit module list</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-inline">
							<label for="txtModuleEditListName" class="control-label mb-2 mr-sm-2 mb-sm-0">List name:</label>
							<input type="text" class="form-control" name="txtModuleEditListName" id="txtModuleEditListName" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnEditModuleListSave">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlDeleteList">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete module list</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this module list? This will remove all associated modules along with it.</p>
					<p class="text-warning" style="font-weight: bold">THIS ACTION CANNOT BE UNDONE!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteListConfirm">Delete</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
	
	<div class="modal" id="mdlEditModule">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit module</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table style="border: 0">
						<tr>
							<td><label for="txtEditModuleCode" class="control-label mb-2 mr-sm-2 mb-sm-0">Module Code:</label></td>
							<td><input type="text" class="form-control" name="txtEditModuleCode" id="txtEditModuleCode" placeholder="XX.XXX" /></td>
						</tr>
						<tr>
							<td><label for="txtEditModuleName" class="control-label mb-2 mr-sm-2 mb-sm-0">Module Name:</label></td>
							<td><input type="text" class="form-control" name="txtEditModuleName" id="txtEditModuleName" /></td>
						</tr>
						<tr>
							<td><label for="txtEditRequiredGrades" class="control-label mb-2 mr-sm-2 mb-sm-0">Required Grades:</label></td>
							<td><input type="text" class="form-control" name="txtEditRequiredGrades" id="txtEditRequiredGrades" value="A,B,C,D" /></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnEditModuleSave">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal" id="mdlDeleteModule">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete module</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this module?</p>
					<p class="text-warning" style="font-weight: bold">THIS ACTION CANNOT BE UNDONE!</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnDeleteModuleConfirm">Delete</button>
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
		var lists = null;
		var modules = null;
		
		function select(listId) {
			if(selected != -1) {
				$("#" + selected).removeClass('bg-info');
			}
			selected = listId;
			$("#" + listId).addClass('bg-info');
			loadListModules(listId);
		}
		
		function loadModules() {
			$.get("scripts/GetModules.php", function(resultData) {
				var resultObject = JSON.parse(resultData);
				
				if(resultObject.success) {
					modules = resultObject.modules;
					var moduleTableHTML = "";
					
					for(var i = 0; i < resultObject.modules.length; i++) {
						moduleTableHTML += "<tr>";
						moduleTableHTML += "<td>" + (i + 1) + "</td>";
						moduleTableHTML += "<td>" + resultObject.modules[i].moduleCode + "</td>";
						moduleTableHTML += "<td>" + resultObject.modules[i].moduleName + "</td>";
						moduleTableHTML += "<td>" + resultObject.modules[i].requiredGrades + "</td>";
						moduleTableHTML += "<td><a href=\"#\" id=\"" + resultObject.modules[i].id + "\" class=\"edit-module\"><i class=\"fa fa-pencil\"></i></a></td>";
						moduleTableHTML += "<td><a href=\"#\" id=\"" + resultObject.modules[i].id + "\" class=\"delete-module\"><i class=\"fa fa-times\"></i></a></td>";
						moduleTableHTML += "</tr>";
					}
					
					$("#tblModules").html(moduleTableHTML);
					
					$(".edit-module").click(function(e) {
						e.preventDefault();
						editModule = $(this).attr('id');
						$("#mdlEditModule").modal();
						for(var i = 0; i < modules.length; i++) {
							if(modules[i].id == $(this).attr('id')) {
								$("#txtEditModuleCode").val(modules[i].moduleCode);
								$("#txtEditModuleName").val(modules[i].moduleName);
								$("#txtEditRequiredGrades").val(modules[i].requiredGrades);
							}
						}
					});
					$("#btnEditModuleSave").unbind().click(function() {
						var moduleCode = $("#txtEditModuleCode").val();
						var moduleName = $("#txtEditModuleName").val();
						var requiredGrades = $("#txtEditRequiredGrades").val();
						
						if(!moduleCode.trim()) {
							$("#txtEditModuleCode")[0].setCustomValidity("Please enter the module's code");
							$("#txtEditModuleCode")[0].reportValidity();
							return;
						}
						else if(!moduleName.trim()) {
							$("#txtEditModuleName")[0].setCustomValidity("Please enter the module's name");
							$("#txtEditModuleName")[0].reportValidity();
							return;
						}
						else if(!requiredGrades.trim()) {
							$("#txtEditRequiredGrades")[0].setCustomValidity("Please enter the required grades to pass");
							$("#txtEditRequiredGrades")[0].reportValidity();
							return;
						}
						$.post("scripts/EditModuleListItem.php", { id: editModule, moduleCode: moduleCode, moduleName: moduleName, requiredGrades: requiredGrades }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlEditModule").modal('hide');
								loadListModules(selected);
							}
						});
					});
					
					$(".delete-module").click(function(e) {
						e.preventDefault();
						deleteModule = $(this).attr('id');
						$("#mdlDeleteModule").modal();
					});
					$("#btnDeleteModuleConfirm").unbind().click(function() {
						$.post("scripts/DeleteModule.php", { id: deleteModule }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlDeleteModule").modal('hide');
								loadListModules(selected);
							}
						});
					});
				}
			});
		}
		
		function loadListModules(listId) {
			$.get("scripts/GetModuleListItems.php?listId=" + listId, function(resultData) {
				var resultObject = JSON.parse(resultData);
				
				if(resultObject.success) {
					modules = resultObject.modules;
					var moduleTableHTML = "";
					
					for(var i = 0; i < resultObject.modules.length; i++) {
						moduleTableHTML += "<tr><td>" + (i + 1) + "</td><td>" + resultObject.modules[i].moduleCode + " - " + resultObject.modules[i].moduleName + "</td><td>" + resultObject.modules[i].requiredGrades + "</td><td><a href=\"#\" id=\"" + resultObject.modules[i].id + "\" class=\"edit-module\"><i class=\"fa fa-pencil\"></i></a></td><td><a href=\"#\" id=\"" + resultObject.modules[i].id + "\" class=\"delete-module\"><i class=\"fa fa-times\"></i></td></a></tr>";
					}
					
					$("#tblListModules").html(moduleTableHTML);
					
					$(".edit-module").click(function(e) {
						e.preventDefault();
						editModule = $(this).attr('id');
						$("#mdlEditModule").modal();
						for(var i = 0; i < modules.length; i++) {
							if(modules[i].id == $(this).attr('id')) {
								$("#txtEditModuleCode").val(modules[i].moduleCode);
								$("#txtEditModuleName").val(modules[i].moduleName);
								$("#txtEditRequiredGrades").val(modules[i].requiredGrades);
							}
						}
					});
					$("#btnEditModuleSave").unbind().click(function() {
						var moduleCode = $("#txtEditModuleCode").val();
						var moduleName = $("#txtEditModuleName").val();
						var requiredGrades = $("#txtEditRequiredGrades").val();
						
						if(!moduleCode.trim()) {
							$("#txtEditModuleCode")[0].setCustomValidity("Please enter the module's code");
							$("#txtEditModuleCode")[0].reportValidity();
							return;
						}
						else if(!moduleName.trim()) {
							$("#txtEditModuleName")[0].setCustomValidity("Please enter the module's name");
							$("#txtEditModuleName")[0].reportValidity();
							return;
						}
						else if(!requiredGrades.trim()) {
							$("#txtEditRequiredGrades")[0].setCustomValidity("Please enter the required grades to pass");
							$("#txtEditRequiredGrades")[0].reportValidity();
							return;
						}
						$.post("scripts/EditModuleListItem.php", { id: editModule, moduleCode: moduleCode, moduleName: moduleName, requiredGrades: requiredGrades }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlEditModule").modal('hide');
								loadListModules(selected);
							}
						});
					});
					
					$(".delete-module").click(function(e) {
						e.preventDefault();
						deleteModule = $(this).attr('id');
						$("#mdlDeleteModule").modal();
					});
					$("#btnDeleteModuleConfirm").unbind().click(function() {
						$.post("scripts/DeleteModule.php", { id: deleteModule }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlDeleteModule").modal('hide');
								loadListModules(selected);
							}
						});
					});
				}
			});
		}
		
		function loadLists() {
			$.get("scripts/GetLists.php", function(data) {
				var response = JSON.parse(data); // Parse the response from JSON
				
				if(response.success) {
					var listListHTML = "";
					for(var i = 0; i < response.lists.length; i++) {
						listListHTML += "<tr><td id=\"" + response.lists[i].id + "\">" + response.lists[i].name + "<span class=\"float-md-right\"><a href=\"#\" id=\"" + response.lists[i].id + "\" class=\"edit-list\"><i class=\"fa fa-pencil\"></i></a>&nbsp;&nbsp;<a href=\"#\" id=\"" + response.lists[i].id + "\" class=\"delete-list\"><i class=\"fa fa-times\"></i></a></span></td></tr>";
					}
					listListHTML += "<tr><td id=\"btnAddModuleList\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i> Add Module List</td></tr>";
					
					$("#detailList").html(listListHTML);
					
					if(response.lists.length > 0) {
						lists = response.lists;
						select(response.lists[0].id);
					}
					
					$("#detailList > tr > td").click(function() {
						var listId = $(this).attr('id');
						if(listId == "btnAddModuleList") {
							return;
						}
						
						select(listId);
					});
					$("#btnAddModuleList").click(function() {
						$("#mdlAddModuleList").modal();
					});
					$("#btnAddModuleListSave").unbind().click(function() {
						var listName = $("#txtModuleListName").val();
						if(listName.trim()) {
							$.post("scripts/AddList.php", { name: listName }, function(resultData) {
								var resultObject = JSON.parse(resultData);
								
								if(resultObject.success) {
									$("#mdlAddModuleList").modal('hide');
									loadLists();
								}
								else {
									$("#txtModuleListName")[0].setCustomValidity(resultObject.message);
									$("#txtModuleListName")[0].reportValidity();
								}
							});
						}
						else {
							$("#txtModuleListName")[0].setCustomValidity("Please enter a name for the list");
							$("#txtModuleListName")[0].reportValidity();
						}
					});
					$(".delete-list").click(function(e) {
						e.preventDefault();
						deleteList = $(this).attr('id');
						$("#mdlDeleteList").modal();
					});
					$("#btnDeleteListConfirm").unbind().click(function() {
						$.post("scripts/DeleteList.php", { listId: deleteList }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
								$("#mdlDeleteList").modal('hide');
								loadLists();
							}
						});
					});
					
					$(".edit-list").click(function(e) {
						e.preventDefault();
						editList = $(this).attr('id');
						$("#mdlEditModuleList").modal();
						for(var i = 0; i < lists.length; i++) {
							if(lists[i].id == $(this).attr('id')) {
								$("#txtModuleEditListName").val(lists[i].name);
							}
						}
					});
					$("#btnEditModuleListSave").unbind().click(function() {
						name = $("#txtModuleEditListName").val();
						$.post("scripts/EditList.php", { listId: editList, name: name }, function(resultData) {
							var resultObject = JSON.parse(resultData);
								
							if(resultObject.success) {
									$("#mdlEditModuleList").modal('hide');
									loadLists();
								}
								else {
									$("#txtModuleEditListName")[0].setCustomValidity(resultObject.message);
									$("#txtModuleEditListName")[0].reportValidity();
								}
						});
					});
				}
			});
		}
		
		function filterModules() {
			// Declare variables 
			var input, filter, table, tr, td, i;
			input = document.getElementById("txtModulesSearch");
			filter = input.value.toUpperCase();
			table = document.getElementById("tblModules");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (tr[i].innerHTML) {
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				} 
			}
		}
		$(document).ready(function() {
			$("#navManage").addClass("active");
			loadLists();
			
			$("#tabModuleLists").click(function(e) {
				e.preventDefault();
				
				$("#paneModuleLists").show();
				$("#paneModules").hide();
				
				$("#tabModuleLists").addClass("active");
				$("#tabModules").removeClass("active");
			});
			$("#tabModules").click(function(e) {
				e.preventDefault();
				
				$("#paneModuleLists").hide();
				$("#paneModules").show();
				
				$("#tabModuleLists").removeClass("active");
				$("#tabModules").addClass("active");
			});
			
			$("#tabModules").click();
			loadModules();
			
			$("#btnAddModule").unbind().click(function(e) {
				e.preventDefault();
				$("#mdlAddModule").modal();
			});
			
			$("#btnAddModuleSave").unbind().click(function() {
				var moduleCode = $("#txtModuleCode").val();
				var moduleName = $("#txtModuleName").val();
				var requiredGrades = $("#txtRequiredGrades").val();
				
				if(!moduleCode.trim()) {
					$("#txtModuleCode")[0].setCustomValidity("Please enter the module's code");
					$("#txtModuleCode")[0].reportValidity();
					return;
				}
				else if(!moduleName.trim()) {
					$("#txtModuleName")[0].setCustomValidity("Please enter the module's name");
					$("#txtModuleName")[0].reportValidity();
					return;
				}
				else if(!requiredGrades.trim()) {
					$("#txtRequiredGrades")[0].setCustomValidity("Please enter the required grades to pass");
					$("#txtRequiredGrades")[0].reportValidity();
					return;
				}
				$.post("scripts/AddModule.php", { listId: selected, moduleCode: moduleCode, moduleName: moduleName, requiredGrades: requiredGrades }, function(resultData) {
					var resultObject = JSON.parse(resultData);
						
					if(resultObject.success) {
						$("#mdlAddModule").modal('hide');
						loadModules();
					}
				});
			});
		});
	</script>
</body>
