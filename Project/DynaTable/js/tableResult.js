$( document ).ready(function() {
  $("#tokenfield-1").on("change paste keyup", function() {
    var input = document.getElementById('tokenfield-1').value;
$('#resultTable').dynatable({
  dataset: {
    ajax: true,
    ajaxUrl: '/Project/DynaTable/script/result.php?q=' + input,
    ajaxOnLoad: true,
    records: []
  }
})})})  ;
