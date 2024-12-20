@if($paginator->hasPages())
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">
        @if ($paginator->onFirstPage()) 
        <li class="page-item disabled"> 
            <a class="page-link" href="#" 
               tabindex="-1"><i class="tf-icon bx bx-chevrons-left"></i></a> 
        </li> 
        @else 
        <li class="page-item"><a class="page-link" 
            href="{{ $paginator->previousPageUrl() }}"> 
            <i class="tf-icon bx bx-chevrons-left"></i></a> 
          </li> 
        @endif 

        @foreach ($elements as $element) 
            @if (is_string($element)) 
            <li class="page-item disabled">{{ $element }}</li> 
            @endif 
  
            @if (is_array($element)) 
                @foreach ($element as $page => $url) 
                    @if ($page == $paginator->currentPage()) 
                    <li class="page-item active"> 
                        <a class="page-link">{{ $page }}</a> 
                    </li> 
                    @else 
                    <li class="page-item"> 
                        <a class="page-link" 
                        href="{{ $url }}">{{ $page }}</a> 
                    </li> 
                    @endif 
                @endforeach 
            @endif 
        @endforeach 
  
        @if ($paginator->hasMorePages()) 
        <li class="page-item"> 
            <a class="page-link" 
               href="{{ $paginator->nextPageUrl() }}"  
               rel="next"><i class="tf-icon bx bx-chevrons-right"></i></a> 
        </li> 
        @else 
        <li class="page-item disabled"> 
            <a class="page-link" href="#"><i class="tf-icon bx bx-chevrons-right"></i></a> 
        </li> 
        @endif 
    </ul>
</nav>
@endif