$(function() {
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true
    });
});

$(function () {
  $('#datetimepickerfrom').datetimepicker();
  $('#datetimepickerto').datetimepicker({
    useCurrent: false //Important! See issue #1075
  });
  $("#datetimepickerfrom").on("dp.change", function (e) {
    $('#datetimepickerto').data("DateTimePicker").minDate(e.date);
  });
  $("#datetimepickerto").on("dp.change", function (e) {
    $('#datetimepickerfrom').data("DateTimePicker").maxDate(e.date);
  });
});
