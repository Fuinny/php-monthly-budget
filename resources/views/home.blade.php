@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2>Sveiki, {{ Auth::user()->name }}!</h2>
                <h5>Šio menėsio biudžėto apžvalga.</h5>
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
                        <h2>{{ number_format($totalExpenses ?? 0, 2) }} €</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 align-items-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white font-weight-bold py-3">Paskutinės operacijos</div>
                    <div class="card-body bg-white">
                        <p class="text-muted text-center my-4">Kol kas jokių operacijų nėra.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
