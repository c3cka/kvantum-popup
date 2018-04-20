$(function () {
  $('#datetimepickerfrom').datetimepicker({
    minDate: new Date(),
    locale: 'hr',
    sideBySide: true
  });
  $('#datetimepickerto').datetimepicker({
    locale: 'hr',
    sideBySide: true,
    useCurrent: false //Important! See issue #1075
  });
  $("#datetimepickerfrom").on("dp.change", function (e) {
    $('#datetimepickerto').data("DateTimePicker").minDate(e.date);
  });
  $("#datetimepickerto").on("dp.change", function (e) {
    $('#datetimepickerfrom').data("DateTimePicker").maxDate(e.date);
  });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
