@extends('layouts.app')
@section('content')
    <div class="alert alert-success">
        {{  session('success') }}
    </div>
<form action="{{ route('authors.store') }}" method="POST">
    @csrf
    {{-- Имя --}}
    <div class="mb-3">
        <label for="first_name" class="form-label">Имя</label>
        <input
            type="text"
            name="first_name"
            id="first_name"
            class="form-control @error('first_name') is-invalid @enderror"
            value="{{ old('first_name') }}"
            required
        >
        @error('first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Фамилия --}}
    <div class="mb-3">
        <label for="last_name" class="form-label">Фамилия</label>
        <input
            type="text"
            name="last_name"
            id="last_name"
            class="form-control @error('last_name') is-invalid @enderror"
            value="{{ old('last_name') }}"
            required
        >
        @error('last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Отчество --}}
    <div class="mb-3">
        <label for="father_name" class="form-label">Отчество</label>
        <input
            type="text"
            name="father_name"
            id="father_name"
            class="form-control @error('father_name') is-invalid @enderror"
            value="{{ old('father_name') }}"
            required
        >
        @error('father_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Дата рождения --}}
    <div class="mb-3">
        <label for="birth_date" class="form-label">Дата рождения</label>
        <input
            type="date"
            name="birth_date"
            id="birth_date"
            class="form-control @error('birth_date') is-invalid @enderror"
            value="{{ old('birth_date') }}"
        >
        @error('birth_date')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Биография --}}
    <div class="mb-3">
        <label for="biography" class="form-label">Биография</label>
        <textarea
            name="biography"
            id="biography"
            rows="4"
            class="form-control @error('biography') is-invalid @enderror"
        >{{ old('biography') }}</textarea>
        @error('biography')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Пол --}}
    <div class="mb-3">
        <label class="form-label d-block">Пол</label>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="gender"
                id="gender_male"
                value="1"
                {{ old('gender') === '1' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="gender_male">Мужской</label>
        </div>

        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="gender"
                id="gender_female"
                value="0"
                {{ old('gender') === '0' ? 'checked' : '' }}
            >
            <label class="form-check-label" for="gender_female">Женский</label>
        </div>

        @error('gender')
        <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Активен --}}
    <div class="mb-3">
        <div class="form-check">
            <input
                type="checkbox"
                name="active"
                id="active"
                class="form-check-input"
                value="1"
                {{ old('active', 1) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="active">Активен</label>
        </div>
        @error('active')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Кнопка --}}
    <button type="submit" class="btn btn-primary">
        Создать автора
    </button>
</form>
@endsection
