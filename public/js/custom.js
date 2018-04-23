// TABLE SORT
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("popup");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

// MODAL ADD/EDIT/PREVIEW
$(document).ready(function(){
  $('#add').click(function(){
    $('#insert').val("Insert");
    $('#insert_form')[0].reset();
  });
  $(document).on('click', '.edit_data', function(){
    var popup_id = $(this).attr("id");
    $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{popup_id:popup_id},
      dataType:"json",
      success:function(data){
        $('#title').val(data.title);
        $('#description').val(data.description);
        $('#valid_from').val(data.valid_from);
        $('#valid_to').val(data.valid_to);
        $('#popup_id').val(data.id);
        $('#insert').val("Update");
        $('#addPopupModal').modal('show');
      }
    });
  });
  $('#insert_form').on("submit", function(event){
    event.preventDefault();
    if($('#title').val() == "")
    {
      alert("Title is required");
    }
    else if($('#description').val() == '')
    {
      alert("Description is required");
    }
    else if($('#valid_from').val() == '')
    {
      alert("Valid from is required");
    }
    else if($('#valid_to').val() == '')
    {
      alert("Valid to is required");
    }
    else
    {
      $.ajax({
        url:"addPopup.php",
        method:"POST",
        data:$('#insert_form').serialize(),
        beforeSend:function(){
          $('#insert').val("Inserting");
        },
        success:function(data){
          $('#insert_form')[0].reset();
          $('#add_data_Modal').modal('hide');
          $('#employee_table').html(data);
        }
      });
    }
  });
  $(document).on('click', '.view_data', function(){
    var employee_id = $(this).attr("id");
    if(employee_id != '')
    {
      $.ajax({
        url:"select.php",
        method:"POST",
        data:{employee_id:employee_id},
        success:function(data){
          $('#employee_detail').html(data);
          $('#dataModal').modal('show');
        }
      });
    }
  });
});
