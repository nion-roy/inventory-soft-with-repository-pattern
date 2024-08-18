@if (isset($paymentHistories))
	@foreach ($paymentHistories as $key => $history)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $history->created_at->format('d-M-Y') }}</td>
			<td>{{ $history->total_amount }}</td>
			<td>{{ $history->payment_amount }}</td>
			<td>{{ $history->due_amount }}</td>
			<td>{{ $history->user->name }}</td>
			<td>
				<button type="button" class="btn btn-danger btn-sm waves-effect waves-light paymentHistoryDelete" order-id="{{ $history->order_id }}" history-id="{{ $history->id }}"><i class="bx bx-trash"></i></button>
			</td>
		</tr>
	@endforeach
@endif
