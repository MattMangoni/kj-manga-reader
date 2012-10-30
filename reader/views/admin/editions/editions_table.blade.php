@layout('layouts.admin')

@section('content')

        <h2>Elenco Edizioni</h2>

        {{ Session::get('status') }}

        <table class="table table-striped">
          <thead>
            <th>ID</th>
            <th>Edizione</th>
            <th>Capitoli</th>
            <th>Status</th>
            <th>Attiva?</th>
          </thead>
          <tbody>
            @foreach($editions as $edition)
            <tr>
              <td>{{ $edition->id }}</td>
              <td>{{ $edition->name }}</td>
              <td>{{ $edition->chapters()->count() }}</td>
              <td>{{ $edition->status }}</td>
              <td> @if($edition->draft == 'yes') No @else Sì @endif </td>
              <td class="span1">{{ HTML::link('admin/editions/edit/'.$edition->id, 'Modifica', array('class' => 'btn btn-success')) }}</td>
              <td class="span1">{{ HTML::link('admin/editions/delete/'.$edition->id, 'Elimina', array('class' => 'btn btn-danger')) }}</td>
              @if($edition->status != 'Chiuso')
                <td class="span1">{{ HTML::link('admin/editions/close/'.$edition->id, 'Chiudi',  array('class' => 'btn btn-inverse')) }}</td>
              @else
                <td class="span1">{{ HTML::link('admin/editions/open/'.$edition->id, 'Riapri',  array('class' => 'btn btn-info')) }}</td>
              @endif

              @if($edition->draft != "no")
                <td class="span1">{{ HTML::link('admin/editions/activate/'.$edition->id, 'Attiva',  array('class' => 'btn btn-info')) }}</td>
              @else
                <td class="span1">{{ HTML::link('admin/editions/deactivate/'.$edition->id, 'Disattiva',  array('class' => 'btn btn-inverse')) }}</td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>

		{{ HTML::link('admin/editions/new', 'Aggiungi una nuova edizione', array('class' => 'btn btn-success')) }}<br /><br />
@endsection