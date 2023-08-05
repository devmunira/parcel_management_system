<nav class="pagination-wrap mt--35 mt-md--25">



@if ($paginator->hasPages())
<ul class="pagination">

    @if ($paginator->onFirstPage())
        <li class="disabled"><a href="#" class="prev page-number"><i class="fa fa-arrow-left"></i></a></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}" class="prev page-number"><i class="fa fa-arrow-left"></i></a></li>
    @endif



    @foreach ($elements as $element)

        @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
        @endif



        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li><span class="current page-number">{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}" class="page-number">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach



    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" class="next page-number"><i class="fa fa-arrow-right"></i></a></li>

    @else
        <li class="disabled"><a href="#" class="next page-number"><i class="fa fa-arrow-right"></i></a></li>

    @endif
</ul>
@endif

</nav>

<div class="dataTables_info mr-2" id="order-table_info" role="status" aria-live="polite">Showing {{ $paginator->firstItem() }} to {{ $paginator->count() }} of {{ $paginator->total() }} entries</div>

