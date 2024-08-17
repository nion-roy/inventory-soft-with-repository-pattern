@if ($paginator->perPage() < $paginator->total())
	<div class="row w-100">
		<div class="col-lg-12">
			<div class="d-flex align-items-center justify-content-between">
				<p class="page-info">Showing {{ $paginator->perPage() }} of {{ $paginator->total() }} Results</p>
				<ul class="pagination gap-2">

					@if ($paginator->onFirstPage())
						<li class="page-item disabled">
							<a class="page-link" href="javascript:void(0)" rel="prev">Previous</a>
						</li>
					@else
						<li class="page-item">
							<a class="page-link bg-success text-white" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
						</li>
					@endif

					@php
						$maxPages = 5; // Set the maximum number of page links to display
						$halfMaxPages = (int) floor($maxPages / 2);
						$startPage = max(1, $paginator->currentPage() - $halfMaxPages);
						$endPage = min($paginator->lastPage(), $paginator->currentPage() + $halfMaxPages);
					@endphp

					@if ($startPage > 1)
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->url(1) }}">1</a>
						</li>
						@if ($startPage > 2)
							<li class="page-item disabled">
								<span>...</span>
							</li>
						@endif
					@endif

					@foreach (range($startPage, $endPage) as $page)
						@if ($page == $paginator->currentPage())
							<li class="page-item">
								<a class="page-link bg-success border-success active" href="{{ $paginator->url($page) }}">{{ $page }}</a>
							</li>
						@else
							<li class="page-item">
								<a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
							</li>
						@endif
					@endforeach

					@if ($endPage < $paginator->lastPage())
						@if ($endPage < $paginator->lastPage() - 1)
							<li class="page-item disabled">
								<span>...</span>
							</li>
						@endif
						<li class="page-item">
							<a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
						</li>
					@endif

					@if ($paginator->hasMorePages())
						<li class="page-item">
							<a class="page-link bg-success text-white" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
						</li>
					@else
						<li class="page-item disabled">
							<a class="page-link" href="javascript:void(0)" rel="next">Next</a>
						</li>
					@endif

				</ul>
			</div>
		</div>
	</div>
@endif
