@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>{{ __('Biudžetas') }}</h2>
            <h5 class="text-muted">{{ __('Nustatykite išlaidų limitus mėnesiui.') }}</h5>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Form: Set Budget -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-white p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">{{ __('Nustatyti limitą') }}</h5>
                    <form action="{{ route('budgets.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="month" value="{{ $month }}">
                        <input type="hidden" name="year" value="{{ $year }}">
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Kategorija') }}
                            </label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" selected disabled>{{ __('Pasirinkite kategoriją') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="amount_limit" class="form-label small text-uppercase text-muted fw-bold">
                                {{ __('Mėnesio limitas') }} (€)
                            </label>
                            <input type="number" step="0.01" name="amount_limit" id="amount_limit" class="form-control @error('amount_limit') is-invalid @enderror" required>
                            @error('amount_limit')
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

        <!-- List: Budgets -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-header bg-white fw-bold py-3">
                    {{ __('Biudžeto limitas – ') }} {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th class="px-4 py-2 border-0 small text-uppercase text-muted">{{ __('Kategorija') }}</th>
                                    <th class="py-2 border-0 small text-uppercase text-muted">{{ __('Limitas') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($budgets as $budget)
                                    <tr>
                                        <td class="px-4 py-3 align-middle">
                                            <span class="fw-bold">{{ $budget->category->name }}</span>
                                        </td>
                                        <td class="px-4 py-3 align-middle">
                                            <span class="fw-bold">{{ number_format($budget->amount_limit, 2) }} €</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-5 text-muted">
                                            {{ __('Nėra nustatytų biudžeto limitų šiam mėnesiui.') }}
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
