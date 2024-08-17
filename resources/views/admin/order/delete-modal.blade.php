<!-- Delete Modal -->
<div class="modal fade bounceUpIn" id="orderDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content p-3">
			<div class="modal-header">
				<h4 class="modal-title" id="orderLabel">Delete Order</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Do You Really Want to Delete This ?
			</div>
			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<form id="orderDeleteForm" method="post">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger waves-effect"><i class="bx bx-trash me-1"></i>Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal -->
