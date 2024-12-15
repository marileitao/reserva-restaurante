<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $mesas = Mesa::all();
        return view('reservas.create', compact('mesas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mesaId' => 'required|exists:mesas,id',
            'nomeCliente' => 'required|string|max:255',
            'dataReserva' => 'required|date|after:now',
        ]);

        $dataReserva = Carbon::parse($request->dataReserva);
        if ($dataReserva->isSunday()) {
            return back()->withErrors(['dataReserva' => 'Reservas não são permitidas aos domingos.']);
        }

        if ($dataReserva->hour < 18 || $dataReserva->hour > 23) {
            return back()->withErrors(['dataReserva' => 'As reservas só são permitidas das 18:00 até as 23:59.']);
        }

        $conflito = Reserva::where('mesaId', $request->mesaId)
                          ->where('dataReserva', $dataReserva)
                          ->exists();

        if ($conflito) {
            return back()->withErrors(['dataReserva' => 'Já existe uma reserva para essa mesa neste horário.']);
        }

        Reserva::create($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva realizada com sucesso!');
    }
}
