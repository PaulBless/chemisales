<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 text-secondary">
                &nbsp; &copy; 2020 - <?php echo date('Y'); ?> Developed by <a target="_blank" href="www.jecmasghana.com">Jecmas</a>
            </div>

        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- Third Party js-->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="assets/libs/peity/jquery.peity.min.js"></script>
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="assets/libs/jquery-nice-select/jquery.nice-select.min.js"></script>

<script src="assets/libs/switchery/switchery.min.js"></script>
<script src="assets/libs/select2/select2.min.js"></script>
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- third party js ends -->

<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-2.init.js"></script>

<!-- Third Party js-->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Tost-->
<script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>

<script src="assets/js/pages/tickets.js"></script>

<!-- Modal-Effect -->
<script src="assets/libs/custombox/custombox.min.js"></script>

<!-- Bootstrap Datepicpicker -->
<script src="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap Select -->
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
<script src="assets/js/pages/form-advanced.init.js"></script>

<!-- Others -->

<!-- Custom JS -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/typeahead.js"></script>

<script src="assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="assets/js/datatables/jszip.min.js"></script>
<script src="assets/js/datatables/pdfmake.min.js"></script>
<script src="assets/js/datatables/vfs_fonts.js"></script>
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<script src="assets/js/datatables/buttons.print.min.js"></script>


<script>
    //ajax loader
    function ajaxloader(){
        $('.preloader').show();
        setTimeout(function(){
            $('.preloader').fadeToggle();
            startclock();
        }, 100)
    }

    // check only numbers on keypress event
    function isNumberKey(evt)
      {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
        return false;
        return true;
      }  

    // function to check inputs
    function acceptLetters(e)
    {
        // allow letters and whitespaces only.
        var inputValue = event.which;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }

    }
</script>

</body>

</html>