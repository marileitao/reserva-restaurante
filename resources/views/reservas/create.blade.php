@extends('layouts.app')

@section('content')
    <h1>Nova Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <label for="mesaId">Mesa:</label>
        <select name="mesaId" id="mesaId">
            @foreach ($mesas as $mesa)
                <option value="{{ $mesa->id }}">{{ $mesa->numero }}</option>
            @endforeach
        </select>

        <label for="nomeCliente">Nome do Cliente:</label>
        <input type="text" name="nomeCliente" id="nomeCliente" required>

        <label for="data_reserva">Data da Reserva:</label>
        <input type="datetime-local" name="data_reserva" id="data_reserva" required 
               min="{{ now()->addMinutes(1)->format('Y-m-d\TH:i') }}" 
               max="{{ now()->endOfDay()->format('Y-m-d\TH:i') }}">

        <button type="submit">Reservar</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection