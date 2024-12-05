@extends('layouts.app')
@section('title', '| Családnevek')

@section('content')
<div class="container">

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Azonosító</th>
                <th>Családnév</th>                
                <th>Létrehozás</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach($names as $name)
            <tr>
                <td>{{ $name->id }}</td>                
                <td>{{ $name->surname }}</td>
                <td>{{ $name->created_at }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger btn-delete-name" data-id="{{ $name->id }}">Törlés</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3 class="mt-3">Új családnév hozzáadása</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/names/manage/surname/new">
        @csrf
        <div class="form-group">
            <label for="inputFamily">Családnév</label>
            <input type="text" class="form-control" id="inputFamily" name="inputFamily" value="{{ old('inputFamily') }}" minlength="2" maxlength="20" required>
        </div>
        <button type="submit" class="btn btn-primary">Hozzáadás</button>
    </form>
</div>
@endsection

@section('script')
    <script>
        $(".btn-delete-name").on('click', function(){
            let thisBtn = $(this);
            let id = thisBtn.data('id');

            $.ajax({
                type: "POST",
                url: '/names/manage/surname/delete',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(){
                    thisBtn.closest('tr').fadeOut();
                },
                error: function(){
                    alert('Nem sikerült a törlés!');
                }
            });
        });
    </script>
@endsection