<!-- Footer Start -->
<!-- <footer class="footer " style="background: linear-gradient(0deg, rgba(255, 0, 150, 0.1), rgba(255, 0, 150, 0.1));"> -->
<footer class="footer bg-light">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <!-- <div class="col-md-6 text-light">
                &nbsp; &copy; 2019 - <?php echo date('Y'); ?> - Powered by <a class="text-white font-weight-normal" >Jecmas </a>
            </div>  -->
            
            <div class="col-md-6 text-secondary">
               &nbsp; &copy; 2021 - Powered by <a class="text-dark " >Jecmas </a>
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
<script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/buttons.html5.min.js"></script>
<script src="assets/libs/datatables/buttons.flash.min.js"></script>
<script src="assets/libs/datatables/buttons.print.min.js"></script>
<script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables/dataTables.select.min.js"></script>
<script src="assets/libs/pdfmake/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/vfs_fonts.js"></script>
<!-- End Third Party Js -->

<!-- Nice Select js ends -->
<script src="assets/libs/jquery-nice-select/jquery.nice-select.min.js"></script>

<!-- Switchery Js -->
<script src="assets/libs/switchery/switchery.min.js"></script>
<script src="assets/libs/select2/select2.min.js"></script>
<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>


<!-- Dashboard init -->
<script src="assets/js/pages/dashboard-2.init.js"></script>

<!-- Canvas Js-->
<script src="assets/libs/canvas/canvasjs.min.js"></script>

<!-- Toast-->
<script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>

<!-- Ticket Js -->
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
<script src="assets/js/pages/toastr.min.js"></script>

 <!-- Plugins js -->
<script src="assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="assets/libs/autonumeric/autoNumeric-min.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-masks.init.js"></script>

<!-- Custom JS -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/typeahead.js"></script>

<!-- Plugin Js  -->
<script src="assets/libs/parsleyjs/parsley.min.js"></script> 

<script src="assets/js/pages/form-validation.init.min.js"></script> 

<!-- <script src="assets/js/datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="assets/js/datatables/dataTables.buttons.min.js"></script> -->
<!-- <script src="assets/js/datatables/jszip.min.js"></script> -->
<!-- <script src="assets/js/datatables/pdfmake.min.js"></script> -->
<!-- <script src="assets/js/datatables/vfs_fonts.js"></script> -->
<!-- <script src="assets/js/datatables/buttons.html5.min.js"></script> -->
<!-- <script src="assets/js/datatables/buttons.print.min.js"></script> -->


<script>
    
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
        if(!(inputValue >= 65 && inputValue <= 123) && (inputValue != 32 && inputValue != 0)) { 
            event.preventDefault(); 
        }
    }
</script>


</body>

</html>