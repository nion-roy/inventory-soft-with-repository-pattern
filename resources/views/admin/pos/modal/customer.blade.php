<!-- Customer Modal -->
<div class="modal fade" id="addNewCustomer" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header pb-2">
				<h4 class="modal-title" id="productLabel">Add New Customer</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body mt-2">

				<div class="row">
					<div class="mb-3 col-md-6">
						<label for="name" class="form-label">Customer Name <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter customer name" value="{{ old('name') }}">
						@error('name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="mb-3 col-md-6">
						<label for="email" class="form-label">Email</label>
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email address" value="{{ old('email') }}">
						@error('email')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="mb-3 col-md-6">
						<label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
						<input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror" id="contact" placeholder="Enter contact number" value="{{ old('contact') }}">
						@error('contact')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="mb-3 col-md-6">
						<label for="address" class="form-label">Address <span class="text-danger">*</span></label>
						<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address" value="{{ old('address') }}">
						@error('address')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-12 mb-3 d-none">
						<div class="form-check">
							<input type="checkbox" name="status" class="form-check-input" id="status" checked>
							<label class="form-check-label" for="status">Active</label>
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<button type="button" class="btn btn-success waves-effect new__customer" id="customer"><i class="bx bx-plus-circle me-1"></i>Add Now</button>
			</div>

		</div>
	</div>
</div>
<!-- Customer Modal -->

