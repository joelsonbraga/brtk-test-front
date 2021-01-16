@extends('layout.home')

@section('content')
    <h4>Listar</h4>
    <button type="button" class="btn btn-secondary" onclick="location.href='{{ route("person.add") }}'">
        Add
    </button>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">CPF</th>
            <th scope="col">E-mail</th>
            <th scope="col">Phone</th>
            <th class="text-right"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($persons as $person)
            <tr class="text-sm">
                <td>{{ $person['name'] }}</td>
                <td>{{ $person['cpf'] }}</td>
                <td>{{ $person['email'] }}</td>
                <td>{{ $person['phone'] }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{route('person.edit', $person['uuid'])}}">
                                    Edit
                                </a>
                                <a class="dropdown-item" href="{{route('person.delete', $person['uuid'])}}">
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
