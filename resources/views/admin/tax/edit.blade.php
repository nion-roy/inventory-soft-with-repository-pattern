<!-- Tax Edit Modal -->
<div class="modal fade" id="taxEditModal" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h4 class="modal-title" id="taxEditLabel">Edit Tax</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<div class="col-lg-6">
						<label for="name_edit" class="col-form-label">Tax Name</label>
						<input type="text" name="name" class="form-control name" id="name_edit" placeholder="Enter tax name">
					</div>
					<div class="col-lg-6">
						<label for="tax_edit" class="col-form-label">Tax Rate</label>
						<input type="number" name="tax" class="form-control tax" id="tax_edit" placeholder="Enter tax rate">
					</div>
				</div>
				<div class="row justify-content-end mb-3">
					<div class="col-12">
						<div class="form-check">
							<input type="checkbox" name="status" class="form-check-input status" id="status_edit">
							<label class="form-check-label" for="status_edit">Active</label>
						</div>
					</div>
				</div>
				<div class="justify-content-end row">
					<div class="col-12">
						<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
						<button type="button" class="btn btn-success waves-effect" id="updateTaxButton"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Tax Edit Modal -->
