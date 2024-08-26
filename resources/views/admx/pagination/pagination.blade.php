<div class="text-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-separate pagination-round pagination-flat justify-content-end">
            @if (!$paginator->onFirstPage())
            <li class="page-item first">
                <a class="page-link" href="{{$paginator->url(1)}}" aria-label="First">
                    <span aria-hidden="true">«</span>
                    <span class="sr-only">First</span>
                </a>
            </li>

            <li class="page-item prev">
                <a class="page-link" href="{{$paginator->previousPageUrl()}}" aria-label="Previous">
                    <span aria-hidden="true">‹</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
{{--            @else--}}
{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link paging-disabled-assets" href="javascript:void(0);" aria-label="First">--}}
{{--                        <span aria-hidden="true">«</span>--}}
{{--                        <span class="sr-only">First</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="page-item disabled">--}}
{{--                    <a class="page-link paging-disabled-assets" href="javascript:void(0);" aria-label="Previous">--}}
{{--                        <span aria-hidden="true">‹</span>--}}
{{--                        <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">{{ $element }}</li>
                @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item next">
                    <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Next">
                        <span aria-hidden="true">›</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>

                <li class="page-item last">
                    <a class="page-link" href="{{$paginator->url($paginator->lastPage())}}" aria-label="Last">
                        <span aria-hidden="true">»</span>
                        <span class="sr-only">Last</span>
                    </a>
                </li>
{{--            @else--}}
{{--                <li class="page-item next disabled">--}}
{{--                    <a class="page-link paging-disabled-assets" href="javascript:void(0);" aria-label="Next">--}}
{{--                        <span aria-hidden="true">›</span>--}}
{{--                        <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="page-item last disabled">--}}
{{--                    <a class="page-link paging-disabled-assets" href="javascript:void(0);" aria-label="Last">--}}
{{--                        <span aria-hidden="true">»</span>--}}
{{--                        <span class="sr-only">Last</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif
        </ul>
    </nav>
</div>