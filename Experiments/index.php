<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Open Data Workflows Elements Demonstration</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript">
		var odwDefaults = ""; 
		
  		$(document).ready(function() {
  	  		$.getJSON("workflows/defaults.json", function(defaults) { 
  	  	  		odwDefaults = defaults;
				//Once defaults are fetched, then get data. 
  	  	  		$.getJSON("workflows/iati-explorer.json",
  	  		  		function(data) {
  			  			$.each(data.steps, function(i, step) {
  				  			buildForm(step);
  				  			
  			  			});
  	  				}
  	  			);
  	  	  	});
  		});

		function buildForm(data) {
			if(typeof(data.process[0]) != 'object') { form_type = "Artifact"; } else { form_type = "Step"; }
			form = "<div class='"+form_type+" step_form'>\n";
			form = form + "<form method='post' action='update' class='"+form_type+"'>\n";
			form = form + "<span class='step_title step_field'><span class='label'>Title</span> <input type='text' name='title' value='"+data.title+"' id='step_title'/></span>\n"
			form = form + "<span class='step_id step_field'><span class='label'>ID</span> <input type='text' name='id' value='"+data.id+"' id='step_id'/></span>\n"
			form = form + "<span class='step_type step_field'><span class='label'>Type</span><select name='artifact_type' id='step_artifact_type'>"+artifactTypes(data.artifact_type)+"</select></span>\n"
			form = form + "<span class='step_description step_field'><span class='label'>Description</span> <textarea type='text' name='description' id='step_description' rows='2' cols='60'>"+data.description+"</textarea></span>\n"			
			form = form + "<span class='step_homepage step_field'><span class='label'>Homepage</span> <input type='text' name='homepage' value='"+data.homepage+"' id='step_homepage'/></span>\n"
				
			if(form_type == "Step") {
				form = form + "<span class='step_section_process'><span class='step_section'>Process</span> Describe the process used to generate this artifact.";
				form = form + "<span class='step_process_type step_field'><span class='label'>Type</span><select name='process-type' id='step_process_type'>"+processTypes(data.process[0].type)+"</select></span>\n"
				form = form + "<span class='step_process_description step_field'><span class='label'>Description</span> <textarea type='text' name='process_description' id='step_process_description' rows='2' cols='60'>"+data.process[0].description+"</textarea></span>\n"	 
				form = form + "</span>";
			}
			//Outputs section
			form = form + "<span class='step_section_outputs'>";
				
			form = form + "</span>";
			

			form = form + "</form>";
			$(".forms").append(form);
		}

		function artifactTypes(value) {
			options = "";
			$.each(odwDefaults.artifacts, function(i, artifact) {
				if(artifact.id == value) { selected = " SELECTED"; } else { selected = ""; }
				options = options + "<option value='"+artifact.id+"'"+selected+">"+artifact.title+"</option>\n";
			});
			return options;
		}
		
		function processTypes(value) {
			options = "";
			$.each(odwDefaults.processes, function(i, process) {
				if(process.id == value) { selected = " SELECTED"; } else { selected = ""; }
				options = options + "<option value='"+process.id+"'"+selected+">"+process.title+"</option>\n";
			});
			return options;
		}
  		
	</script>
</head>
<body>

<div class="forms"></div>
	

</body>
</html>
