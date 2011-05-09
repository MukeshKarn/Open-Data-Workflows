$(document).ready(function() {
  			$.getJSON("workflows/iati-explorer.json",
  		  		function(data) {
		  			$.each(data.steps, function(i, step) {
			  			alert(step.id);		
		  			});
  				}
  			);
  		});