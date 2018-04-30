$(window).on('load', function(){
  var value = $('#popup_id').attr("data-id");
  $('#popupModal .modal-body-popup').load('fetchSpecific.php?id=' + value, function () {
    $('#popupModal').modal({show:true});
  });
});
