// MODAL ADD/EDIT/PREVIEW
$(document).ready(function(){
  // $('#add').click(function(){
  //   $('#insert').val("Insert");
  //   $('#insert_form')[0].reset();
  // });
  $(document).on('click', '.editButton', function(){
    var popup_id = $(this).attr("data-id");
    $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{popup_id:popup_id},
      dataType:"json",
      success:function(data){
        $('#title').val(data.title);
        CKEDITOR.instances['description'].setData(data.description);
        //$('#description').val(data.description);
        $('#image').attr('src', 'upload/' + data.image);
        $('#valid_from').val(data.valid_from);
        $('#valid_to').val(data.valid_to);
        $('#popup_id').val(data.id);
        $('#insert').val("Update");
        $('#addPopupModal').modal('show');
      }
    });
  });
  $(document).on('click', '.deleteButton', function () {
    var popup_id = $(this).attr("data-id");
    $.ajax({
      url: 'administratePopup.php',
      method: 'POST',
      data: {popup_id:popup_id}
    });
  })
  // $('#addPopup').on("submit", function(event){
  //   event.preventDefault();
  //   if($('#title').val() == "")
  //   {
  //     alert("Title is required");
  //   }
  //   else if($('#description').val() == '')
  //   {
  //     alert("Description is required");
  //   }
  //   else if($('#valid_from').val() == '')
  //   {
  //     alert("Valid from is required");
  //   }
  //   else if($('#valid_to').val() == '')
  //   {
  //     alert("Valid to is required");
  //   }
  //   else
  //   {
  //     $.ajax({
  //       url:"addPopup.php",
  //       method:"POST",
  //       data:$('#addPopup').serialize(),
  //       beforeSend:function(){
  //         $('#insert').val("Inserting");
  //       },
  //       success:function(data){
  //         $('#addPopup')[0].reset();
  //         $('#addPopupModal').modal('hide');
  //         $('#popup').html(data);
  //       }
  //     });
  //   }
  // });
//   $(document).on('click', '.view_data', function(){
//     var employee_id = $(this).attr("id");
//     if(employee_id != '')
//     {
//       $.ajax({
//         url:"select.php",
//         method:"POST",
//         data:{employee_id:employee_id},
//         success:function(data){
//           $('#employee_detail').html(data);
//           $('#dataModal').modal('show');
//         }
//       });
//     }
//   });

});

// INITIALIZE TABLE
$(document).ready(function () {
  $('#popup').DataTable({
    order: [[2, 'desc']],
    scrollX: true,
    responsive: true,
    columnDefs: [{
      targets: [0, 1],
      render: $.fn.dataTable.render.ellipsis( 100, true )
    },{
      targets: 4,
      orderable: false
    }],
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
    },
    columns: [

    ]
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
