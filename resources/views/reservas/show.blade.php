@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Reserva</h1>

        <table class="table">
            <tr>
                <th>Mesa</th>
                <td>{{ $reserva->mesa->numero }}</td>
            </tr>
            <tr>
                <th>Data da Reserva</th>
                <td>{{ $reserva->data_reserva->format('d/m/Y H:i') }}</td>
            </tr>
        </table>

        <a href="{{ route('reservas.index') }}" class="btn btn-primary">Voltar para minhas reservas</a>
    </div>
@endsection