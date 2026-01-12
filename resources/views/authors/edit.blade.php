@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование автора</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f7f9;
            padding: 20px;
        }

        .form-wrapper {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            outline: none;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-save {
            background: #16a34a;
            color: #ffffff;
        }

        .btn-save:hover {
            background: #15803d;
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #111827;
        }

        .btn-cancel:hover {
            background: #d1d5db;
        }
    </style>
</head>
<body>
@if(session('success'))
<div class="alert alert-success">
    {{  session('success') }}
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0;padding-left:18px">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-wrapper">
    <h2>Редактирование автора</h2>

    <form method="POST" action="{{ route('authors.update', $author->id) }}">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="form-group">
                <label>Имя</label>
                <input type="text" name="first_name" value="{{ old('first_name', $author->first_name) }}">
            </div>

            <div class="form-group">
                <label>Фамилия</label>
                <input type="text" name="last_name" value="{{ old('last_name', $author->last_name) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Отчество</label>
            <input type="text" name="father_name" value="{{ old('father_name', $author->father_name) }}">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Дата рождения</label>
                <input type="date" name="birth_date"
                       value="{{ old('birth_date', $author->birth_date?->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label>Пол</label>
                <select name="gender">
                    <option value="male" @selected(old('gender', $author->gender) === 'male')>Мужской</option>
                    <option value="female" @selected(old('gender', $author->gender) === 'female')>Женский</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Биография</label>
            <textarea name="biography">{{ old('biography', $author->biography) }}</textarea>
        </div>
        @if($author->user_id == auth()->user()->id || auth()->user()->isAdmin())
        <div class="form-group checkbox-group">
            <input type="checkbox" name="active" value="1"
                @checked(old('active', $author->active))>
            <label>Активен</label>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-save">Сохранить</button>
            <a href="{{ route('authors.index') }}" class="btn btn-cancel">Отмена</a>
        </div>
        @endif
    </form>
</div>

</body>
</html>
@endsection
