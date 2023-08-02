<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<!--Start footer-->
<footer class="footer">
    <div class="container">
        <div class="text-center">
            © 2023 Centre for Health Informatics, Ministry of Health and Family Welfare (MoHFW), Government of India.
        </div>
    </div>
</footer>
<!--End footer-->



</div><!--End wrapper-->


<!-- jquery-->
<!-- Bootstrap core JavaScript-->

<script src="<?= base_url('assets/backend/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/js/bootstrap.min.js'); ?>"></script>

<!-- simplebar js -->
<script src="<?= base_url('assets/backend/plugins/simplebar/js/simplebar.js'); ?>"></script>
<!-- sidebar-menu js -->
<script src="<?= base_url('assets/backend/js/sidebar-menu.js'); ?>"></script>

<!-- Custom scripts -->
<script src="<?= base_url('assets/backend/js/app-script.js'); ?>"></script>
<script src="<?= base_url('assets/backend/js/bootstrap-datepicker.js'); ?>"></script>
<!-- Custom Js -->
<script type="text/javascript" src="<?= base_url('assets/backend/js/table2excel.js'); ?>"></script>

<!--Data Tables js-->

<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/jszip.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/bootstrap-datatable/js/buttons.colVis.min.js'); ?>"></script>

<!--<script src="<?= base_url('assets/backend/js/freeze-table.js'); ?>"></script>-->

<!--<script>
$(".table-basic").freezeTable();
</script>  -->

<script>
$(function(){


   $('.div1').width($('.div2').width());
    $(".wrapper1").scroll(function(){
        $(".wrapper2")
            .scrollLeft($(".wrapper1").scrollLeft());
    });
    $(".wrapper2").scroll(function(){
        $(".wrapper1")
            .scrollLeft($(".wrapper2").scrollLeft());
    });
});
</script>
<script>
function storedata(sno){
  //var data=["cand_id","status_id"];
  var cand_id=$('#cand_id_'+sno).val();
  var status_id=$('#cos_id_'+sno).val();
  url='<?php echo base_url()."admin/Participants/insertData" ?>'
  $.ajax({
    url:url,
    type:'POST',
    data:{'cand_id':cand_id,
          'status_id':status_id
          },

    success: function(result) {
            alert(result);
            //$("#h11").html(result);
                }
  });
}

</script>


<script>
    $(document).ready(function () {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');

    });

</script>

<script>

   var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#dpd1').datepicker({
        onRender: function (date) {
            $("#dpd1").datepicker({format: 'yyyy-mm-dd'});
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            $("#dpd1").datepicker({format: 'yyyy-mm-dd'});
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').datepicker({
        onRender: function (date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function (ev) {
        checkout.hide();
    }).data('datepicker');
</script>
<script type="text/javascript">
        function Export() {
            $(".table_download").table2excel({
                filename: "Table.xls"
            });
        }
    </script>

</body>
</html>
