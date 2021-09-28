
<div class="modal fade" id="contohModalBesarl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      	<form action="index.php" method="get" id="form_tgl" >
	      	<div class="modal-header">
	          <h4 class="modal-title" id="myModalLabel">Choose Your Date</h4>
	        </div>
	        <div class="modal-body">
				<input type="date" class="form-control" name="dateform" value="<?php echo $date; ?>" min="<?php echo $dateMin; ?>">
	        </div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
	    		<button type="submit" class="btn btn-primary" name="find" value="true">GO</button>
	    	</div>
    	</form>
      </div>
    </div>
  </div>