$(document).ready(function(){
	$("#project").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readProject.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#project").css("background","#FFF url(loadericon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-project").show();
			$("#suggesstion-project").html(data);
			$("#project").css("background","#FFF");
		}
		});
	});
});
//To select country name
function selectRow(val) {
$("#project").val(val);
$("#suggesstion-project").hide();
}