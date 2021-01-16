@extends('layout.home')

@section('content')
    <h4>Edit</h4>
    <hr>
    <form method="post" action="{{route('person.update', $person['uuid'])}}">
        @csrf
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="000.000.000-00" required value="{{$person['cpf']}}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Informe o seu nome" required  value="{{$person['name']}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required  value="{{$person['email']}}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" name="phone" class="form-control" id="email" placeholder="(00) 0000-0000" required  value="{{$person['phone']}}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-secondary">Limpar</button>
    </form>
@endsection
