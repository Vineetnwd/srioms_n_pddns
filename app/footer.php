 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='view_data'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalCenterTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/fullcalendar.min.js"></script>
<script src="assets/js/bootadmin.min.js"></script>
<script src="assets/js/notify.min.js"></script>
<script src="https://use.fontawesome.com/b6e01bc9b6.js"></script>
<script src="assets/js/bootbox.all.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/apprise.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	$(document).ready(function () {
		$('#data_tbl').dataTable({
			aLengthMenu: [
				[10,25, 50, 100, 500, -1],
				[10,25, 50, 100, 500, "All"]
			],
			iDisplayLength: 25
		});
		
    $('.offselect').select2();
	$('.view_data').on('click', function(e){
	  e.preventDefault();
	  $('#view_data').modal('show').find('.modal-title').html($(this).attr('data-title'));
	  $('#view_data').modal('show').find('.modal-body').load($(this).attr('data-href'));
	});
	});
</script>
<?php
if(isset($_SESSION['user_id']))
{
    echo "<script>checkTime();</script>";
}
?>
</body>

</html>