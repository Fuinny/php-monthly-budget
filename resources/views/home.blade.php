@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2>Sveiki, {{ Auth::user()->name }}!</h2>
                <h5>Tai Jūsų mėnesio biudžeto apžvalga.</h5>
            </div>
        </div>
        <div class="row mb-4 align-items-center">
            <div class="col-md-4 mb-3">
                <div class="card border-0 bg-dark shadow-sm text-center text-white p-3">
                    <div class="card-body">
                        <h5 class="text-uppercase small">Likutis</h5>
                        <h2>{{ number_format($balance ?? 0, 2) }} €</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 bg-success shadow-sm text-center text-white p-3">
                    <div class="card-body">
                        <h5 class="text-uppercase small">Pajamos</h5>
                        <h2>{{ number_format($totalIncome ?? 0, 2) }} €</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 bg-danger shadow-sm text-center text-white p-3">
                    <div class="card-body">
                        <h5 class="text-uppercase small">Išlaidos</h5>
                        <h2>{{ number_format($totalExpense ?? 0, 2) }} €</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 align-items-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white font-weight-bold py-3">
                        Paskutinės operacijos
                    </div>
                    <div class="card-body bg-white p-0">
                        @if($transactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td class="px-4">
                                                    <div class="fw-bold">{{ $transaction->category->name }}</div>
                                                    <small class="text-muted">{{ $transaction->date }}</small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $transaction->description}}</small>
                                                </td>
                                                <td class="px-4">
                                                    <span class="fw-bold
                                                    {{ $transaction->category->type == 'income'
                                                        ? 'text-success' : 'text-danger'}}">
                                                        {{ $transaction->category->type == 'income' ? '+' : '-' }}
                                                        {{ number_format($transaction->amount, 2) }} €
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted text-center my-4">Kol kas jokių operacijų nėra.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
