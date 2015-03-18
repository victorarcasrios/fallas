$(document).ready(function(){
	$recordsNumber = $("#recordsNumber");
	$("#recordsNumber").val(15);

	$recordsNumber.on('change', refreshTopTable);
});

function refreshTopTable(){
	jQuery.get( "/fallas/top/"+$recordsNumber.val(), function(response){
		console.log(response);
	} );
}