@layout('layouts.default')


@section('main')
   <div class="container">

      <div class="row">
        <div class="span12">
          <div class="page-header">
            <h1>Online Reader <small>Leggi online tutti i capitoli del manga project</small></h1>
          </div>
          <ul class="breadcrumb">
            <li>
              <a href="{{ URL::home() }}edizioni/{{ $chapter->edition->id }}">{{ $chapter->edition->name }}</a> <span class="divider">/</span>
            </li>
            <li>
              <a href="{{ URL::home() }}serie/{{ $series->id }}">{{ $series->series_name }}</a> <span class="divider">/</span>
            </li>
            <li class="active">
              Capitolo {{ $chapter->chapter_num }}
            </li>
          </ul>
        </div>
      </div>

    </div> <!-- /container -->

    <div class="container">
      <div class="row">
        <div class="span12 pagination-centered">

          <img style="box-shadow: 0 0 12px #666;" src="{{ URL::home() }}uploads/{{ $series->slug }}/{{ $chapter->chapter_num }}/{{ $files[$current_page - 1] }}">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="pagination pagination-centered">
            <ul>

              @if($current_page == 1)
                <li class="active"><a href="#">«</a></li>
              @else
                <li><a href="{{ URL::home() }}read/{{ $series->slug }}/{{ $chapter->chapter_num }}/{{ $current_page - 1 }}">«</a></li>
              @endif

              @for($i = 0; $i < count($files); $i++)
                <li
                  @if($i + 1 == $current_page)
                    class="active"
                  @endif
                  >
                  <a href="{{ URL::home() }}read/{{ $series->slug }}/{{ $chapter->chapter_num }}/{{ $i + 1 }}">{{ $i + 1 }}</a>
                </li>
              @endfor

              @if($current_page == count($files))
                <li class="active"><a href="#">»</a></li>
              @else
                <li><a href="{{ URL::home() }}read/{{ $series->slug }}/{{ $chapter->chapter_num }}/{{ $current_page + 1 }}">»</a></li>
              @endif

            </ul>
          </div>
        </div>
      </div>
    </div>
@endsection