@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Minhas Reservas</h1>
        <a href="{{ route('reservas.create') }}" class="btn btn-primary">Nova Reserva</a>

        @if($reservas->isEmpty())
            <p>Você ainda não fez nenhuma reserva.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Data da Reserva</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->mesa->numero }}</td>
                            <td>{{ $reserva->data_reserva->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('reservas.show', $reserva->id) }}" class="btn btn-info">Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection