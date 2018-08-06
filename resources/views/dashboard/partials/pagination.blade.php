
@if ($result->total() > $result->perPage())
    <div class="pagination-wrapper pt-3 pl-3">
        {{ $result->appends(\Request::except(['page']))->links() }}
    </div>
@endif