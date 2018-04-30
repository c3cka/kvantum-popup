<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 25.4.2018.
 * Time: 14:54
 */

?>


<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Popup preview NoCookie</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css/custom_datepicker.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="ckeditor/contents.css">
    <script src="js/popper.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script src="js/ellipsis.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/popup_noCookie.js"></script>

  </head>
  <body class="comments">

    <h1>Popup preview</h1>
    <p>Popup should be shown in modal above this text upon loading page</p>

    <div id="popupModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
          </div>
        </div>

      </div>
    </div>

  </body>
</html>
