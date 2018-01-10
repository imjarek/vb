@if(!empty($paginate) && $paginate->lastPage() !== 0 && $paginate->lastPage() !== 1)

    @php($currentPage = (int)$paginate->currentPage())

    <nav class="align-center {{ $paginationClass or 'm-t-25 m-b-20' }}">
        <ul class="pagination">

            <li class="{{ $currentPage === 1 ? 'disabled' : '' }}">
                <a href="{{ $paginate->url(1) }}" {!! $currentPage === 1 ? 'onclick="return false;" disabled' : '' !!}>
                    <i class="ti-angle-double-left"></i>
                </a>
            </li>

            @if(($currentPage - 4) > 0 && !$paginate->hasMorePages())
                <li><a href="{{ $paginate->url($currentPage - 4) }}">{{ $currentPage - 4 }}</a></li>
            @endif
            @if(($currentPage - 3) > 0 && ($currentPage + 2) > $paginate->lastPage())
                <li><a href="{{ $paginate->url($currentPage - 3) }}">{{ $currentPage - 3 }}</a></li>
            @endif
            @if(($currentPage - 2) > 0)
                <li><a href="{{ $paginate->url($currentPage - 2) }}">{{ $currentPage - 2 }}</a></li>
            @endif
            @if(($currentPage - 1) > 0)
                <li><a href="{{ $paginate->url($currentPage - 1) }}">{{ $currentPage - 1 }}</a></li>
            @endif

            <li class="active"><a href="#" onclick="return false;" disabled>{{ $currentPage }}</a></li>

            @if(($currentPage + 1) <= $paginate->lastPage())
                <li><a href="{{ $paginate->url($currentPage + 1) }}">{{ $currentPage + 1 }}</a></li>
            @endif
            @if(($currentPage + 2) <= $paginate->lastPage())
                <li><a href="{{ $paginate->url($currentPage + 2) }}">{{ $currentPage + 2 }}</a></li>
            @endif
            @if(($currentPage + 3) <= $paginate->lastPage() && $currentPage <= 2)
                <li><a href="{{ $paginate->url($currentPage + 3) }}">{{ $currentPage + 3 }}</a></li>
            @endif
            @if(($currentPage + 4) <= $paginate->lastPage() && $currentPage == 1)
                <li><a href="{{ $paginate->url($currentPage + 4) }}">{{ $currentPage + 4 }}</a></li>
            @endif

            <li class="{{ $paginate->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $paginate->url($paginate->lastPage()) }}" {!! $paginate->hasMorePages() ? '' : 'onclick="return false;" disabled' !!}>
                    <i class="ti-angle-double-right"></i>
                </a>
            </li>

        </ul>
    </nav>
@else
    <nav class="{{ $paginationEmptyClass or '' }}"></nav>
@endif