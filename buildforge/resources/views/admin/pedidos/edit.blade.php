@extends('layouts.admin')

@section('content')
    <h1>Editar Pedido #{{ $pedido->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            @foreach(['pendente', 'processando', 'enviado', 'entregue', 'cancelado'] as $status)
                <option value="{{ $status }}" @if($pedido->status == $status) selected @endif>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <button type="submit">Atualizar</button>
    </form>
@endsection
