@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список книг</title>

    <style>
        /* Оставляем все стили без изменений — они отлично подходят */
        body {
            font-family: Arial, sans-serif;
            background: #f6f7f9;
            padding: 20px;
        }

        .table-wrapper {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2c3e50;
            color: #fff;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        th {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
        }

        tbody tr:hover {
            background: #f1f5f9;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .description {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 6px;
            padding-left: 0;
            margin: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination .page-link,
        .pagination a,
        .pagination span {
            display: block;
            padding: 10px 16px;
            font-size: 15px;
            color: #2c3e50;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background: #2c3e50;
            color: #ffffff;
            border-color: #2c3e50;
        }

        .pagination .active span {
            background: #2c3e50;
            color: #ffffff;
            border-color: #2c3e50;
            cursor: default;
        }

        .pagination .disabled span {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .filter-input {
            width: 280px;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .filter-input:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.15);
        }

        .filter-button {
            padding: 10px 18px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            background: #2c3e50;
            color: #ffffff;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .filter-button:hover {
            background: #1f2f3d;
        }

        .btn-edit {
            display: inline-block;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            background: #2563eb;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-edit:hover {
            background: #1d4ed8;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3);
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2>Список книг</h2>

<form method="GET" action="{{ url()->current() }}" class="filter-form">
    <input
        type="text"
        name="search"
        placeholder="Поиск по названию книги..."
        value="{{ request('search') }}"
        class="filter-input"
    >

    <button type="submit" class="filter-button">
        Поиск
    </button>
</form>

<div class="table-wrapper">
    <table>
        <thead>
        <tr>
            <th>Название</th>
            <th>Автор</th>
            <th>Описание</th>
            <th>Дата создания</th>
            <th>Издательство</th>
            <th>Действия</th>
        </tr>
        </thead>

        <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{ $book->name }}</td>
                <td>
                    {{ $book->author->last_name ?? '—' }}
                    {{ $book->author->first_name ?? '' }}
                    {{ $book->author->father_name ?? '' }}
                </td>
                <td class="description" title="{{ $book->description }}">
                    {{ $book->description ?? '—' }}
                </td>
                <td>{{ \Carbon\Carbon::parse($book->created_date)->format('d.m.Y') }}</td>
                <td>
                    {{ $book->company->name ?? '—' }}
                </td>
                <td>
                    @if(auth()->user()->can('books_authors'))
                        <a href="{{ route('books.edit', $book->id) }}" class="btn-edit">
                            Редактировать
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:20px;">
                    Книг не найдено
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $books->links() }}
</div>

</body>
</html>
@endsection
