@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>{{ __('Operacijos') }}</h2>
            <h5 class="text-muted">{{ __('Sekite savo pajamas ir išlaidas.') }}</h5>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Form: Add Transaction -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">{{ __('Pridėti naują') }}</h5>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Kategorija') }}
                            </label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" selected disabled>{{ __('Pasirinkite kategoriją') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type == 'income' ? __('Pajamos') : __('Išlaidos') }})</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Suma') }} (€)
                            </label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Data') }}
                            </label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ date('Y-m-d') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Aprašymas') }}
                            </label>
                            <textarea name="description" id="description" rows="2" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-2 text-uppercase fw-bold small">
                            {{ __('Išsaugoti') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List: Transactions -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-header bg-white fw-bold py-3">
                    {{ __('Paskutinės operacijos') }}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td class="px-4 py-3 align-middle">
                                            <div class="fw-bold">{{ $transaction->category->name }}</div>
                                            <small class="text-muted">{{ $transaction->date }}</small>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <small class="text-muted">{{ $transaction->description }}</small>
                                        </td>
                                        <td class="px-4 py-3 text-end align-middle">
                                            <span class="fw-bold {{ $transaction->category->type == 'income' ? 'text-success' : 'text-danger' }}">
                                                {{ $transaction->category->type == 'income' ? '+' : '-' }}
                                                {{ number_format($transaction->amount, 2) }} €
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">
                                            {{ __('Nėra užregistruotų operacijų.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
