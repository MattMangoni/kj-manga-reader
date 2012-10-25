@layout('layouts.admin')

@section('content')
        <table class="table table-striped">
          <thead>
            <th>ID</th>
            <th>Edizione</th>
            <th>Capitoli</th>
            <th>Status</th>
          </thead>
          <tbody>
            <tr>
            @foreach($editions as $edition)
              <td>{{ $edition->id }}</td>
              <td>{{ $edition->name }}</td>
              <td>{{ $edition->chapters()->count() }}</td>
              <td>{{ $edition->status }}</td>
              <td>{{ HTML::link('admin/editions/edit/'.$edition->id, 'Modifica', array('class' => 'btn')) }}</td>
              <td>{{ HTML::link('admin/editions/delete/'.$edition->id, 'Elimina', array('class' => 'btn btn-danger')) }}</td>
              @if($edition->status != 'Chiuso')
                <td>{{ HTML::link('admin/editions/close/'.$edition->id, 'Chiudi',  array('class' => 'btn btn-inverse')) }}</td>
              @else
                <td>{{ HTML::link('admin/editions/open/'.$edition->id, 'Riapri',  array('class' => 'btn btn-info')) }}</td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>

		{{ HTML::link('admin/editions/new', 'Aggiungi una nuova edizione', array('class' => 'btn btn-success')) }}<br /><br />
@endsection