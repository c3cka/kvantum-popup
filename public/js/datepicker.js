$(function() {
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true
    });
});

//$.datetimepicker.setLocale('hr');
$(function () {
  $("#datetimepickerfrom").datetimepicker({
    format: 'd.m.Y H:i',
    step: 5,
    onShow: function (ct) {
      this.setOptions({
        maxDate: $("#datetimepickerto").val() ? $("#datetimepickerto").val() : false
      })
    }
  });
  $("#datetimepickerto").datetimepicker({
    format: 'd.m.Y H:i',
    step: 5,
    onShow: function (ct) {
      console.log($("#datetimepickerfrom").val());
      this.setOptions({
        minDate: $("#datetimepickerfrom").val() ? $("#datetimepickerfrom").val() : new Date()
      })
    }
  });
});
