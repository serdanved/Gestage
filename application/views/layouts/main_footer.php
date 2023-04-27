        <!-- jQuery 2.2.3 -->
        <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="<?php echo site_url('resources/js/select2.full.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
        <!-- DataTables.net -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>


        <!--
        <script src="<?php echo site_url('resources/js/jquery.dataTables.js');?>"></script>
        <script src="<?php echo site_url('resources/js/dataTables.bootstrap.js');?>"></script>
         -->

        <script src="<?php echo site_url('resources/bootstrap-form-helper/dist/js/bootstrap-formhelpers.min.js');?>"></script>
        <!-- FineUploader.com -->
        <script src="<?php echo site_url('resources/fine-uploader/jquery.fine-uploader.js');?>"></script>

        <!-- https://github.com/RobinHerbots/Inputmask -->
        <script src="<?php echo site_url('resources/Inputmask/dist/jquery.inputmask.bundle.js');?>"></script>

        <!-- Main Javascript-->
        <script src="<?php echo site_url('resources/js/message.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js?v=3243fdsfssdfsdfsd');?>"></script>

        <script src="<?php echo site_url('resources/js/test.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-confirmation.min.js');?>"></script>

        <script src="<?php echo site_url('resources/js/tinymce/tinymce.min.js');?>"></script>
        <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
        <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

        <script type="text/javascript">
        tinymce.init({
            selector : "textarea:not(.mceNoEditor)",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            font_formats: 'Arial=arial,helvetica=helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
            height: 500,
            convert_urls: false,
            relative_urls: false,
            remove_script_host: false,
          });
        </script>

        <script type="text/javascript" src="/resources/timepicker/bootstrap-timepicker.min.js"></script>

<script> //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,defaultTime: '12:00', showMeridian: false
    })</script>


<script>

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
    btnOkLabel: "Oui",
    btnCancelLabel: "Non",
  // other options
});

</script>
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script> -->
        <script src="<?php echo site_url('blitz/BlitzFrameworkInitiateJS');?>"></script>
        <?php date_default_timezone_set('America/New_York');?>
