// // MODAL ADD/EDIT/PREVIEW
$(document).ready(function(){
  $(document).on('click', '.deleteButton', function () {
    var popup_id = $(this).attr("data-id");
    $.ajax({
      url: 'administratePopup.php',
      method: 'POST',
      data: {popup_id:popup_id}
    });
  });
});

// INITIALIZE TABLE
$(document).ready(function () {
  $('#popup').DataTable({
    order: [[3, 'desc']],
    scrollX: true,
    responsive: true,
    columnDefs: [{
      targets: [0, 1],
      render: $.fn.dataTable.render.ellipsis( 20, true )
    },{
      targets: [2, 5],
      orderable: false
    }
    //   {
    //   targets: [3, 4],
    //   type: 'date'
    // }
    ],
    language: {
      "sEmptyTable":      "Nema podataka u tablici",
      "sInfo":            "Prikazano _START_ do _END_ od _TOTAL_ rezultata",
      "sInfoEmpty":       "Prikazano 0 do 0 od 0 rezultata",
      "sInfoFiltered":    "(filtrirano iz _MAX_ ukupnih rezultata)",
      "sInfoPostFix":     "",
      "sInfoThousands":   ",",
      "sLengthMenu":      "Prikaži _MENU_ rezultata po stranici",
      "sLoadingRecords":  "Dohvaćam...",
      "sProcessing":      "Obrađujem...",
      "sSearch":          "Pretraži:",
      "sZeroRecords":     "Ništa nije pronađeno",
      "oPaginate": {
        "sFirst":       "Prva",
          "sPrevious":    "Nazad",
          "sNext":        "Naprijed",
          "sLast":        "Zadnja"
      },
        "oAria": {
        "sSortAscending":  ": aktiviraj za rastući poredak",
          "sSortDescending": ": aktiviraj za padajući poredak"
      }
    }
  });
});

function preview_image(event)
{
  var reader = new FileReader();
  reader.onload = function()
  {
    var output = document.getElementById('output_image');
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}

$(window).on('load', function(){
  $('#popupModal .modal-body').load('fetch.php', function () {
    var value = $('#popup_id').attr("data-id");
    document.cookie = "popup_" + value + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    if (!$.cookie('popup_' + value)) {
      $('#popupModal').modal({show:true});
      document.cookie = "popup_" + value + "=shown";
      //var cookie = $.cookie('popup_' + value);
      //alert(cookie);
    }
  });
});

