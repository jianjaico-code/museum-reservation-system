<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal row-border" method="POST">
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">From</label>
						<div class="col-sm-10">
							<input type="time" class="form-control" id="inputEmail3" placeholder="Email" name="from">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">To</label>
						<div class="col-sm-10">
							<input type="time" class="form-control" id="inputEmail3" placeholder="Email" name="to">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"  name="Save">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>