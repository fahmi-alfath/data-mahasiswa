<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<script>
  $(document).ready(function() {
      $('#example').DataTable({
        "columns": [
            { "width": "5%" },
            { "width": "10%" },
            null,
            { "width": "13%" },
            { "width": "20%" },
            { "width": "10%" },
            { "width": "5%" },
            { "width": "10%" }
          ]
        });
    });
</script>