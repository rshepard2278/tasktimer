
$(document).ready(function(){
  loadContent();
});


function fillTask(selectedTask) {
  //alert(selectedTask);
  var value =  $('#task-select').find(":selected").text();
  $('#task').val(value);
}

function fillProject(selectedTask) {
  //alert(selectedTask);
  var value =  $('#project-select').find(":selected").text();
  $('#project').val(value);
}

function loadContent() {

  var items = "<option value='default'>default</option>";
  $.getJSON("get_from_db.php",function(data){
    //console.log(data);

    $.each(data,function(index,item) 
    {
      items += "<option value='" + item +  "'>" + item + "</option>";
    });
    $("#task-select").html(items); 
  });

  var html = "<option value='default'>default</option>";
  $.getJSON("get_project.php",function(data){
    //console.log(data);

    $.each(data,function(index,item) 
    {
      html += "<option value='" + item +  "'>" + item + "</option>";
    });
    $("#project-select").html(html); 
  });


 $.post("get-recent.php",
        {
        task: '',
        time: '',
        },
        
        function(data,status){
          //alert(data);
          var tableHead = $("#table-header")
          $("#recent-table").empty();
          $("#recent-table").append(tableHead); 
          $("#recent-table").append(data); 
        });
}
