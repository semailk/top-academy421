@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>

    <style>
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

        .gender {
            text-transform: capitalize;
        }

        .biography {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* =========================
   Pagination (Laravel safe)
   ========================= */

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

        /* Hover */
        .pagination a:hover {
            background: #2c3e50;
            color: #ffffff;
            border-color: #2c3e50;
        }

        /* Active page */
        .pagination .active span {
            background: #2c3e50;
            color: #ffffff;
            border-color: #2c3e50;
            cursor: default;
        }

        /* Disabled */
        .pagination .disabled span {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        /* Large pagination */
        .pagination-lg .page-link {
            padding: 14px 22px;
            font-size: 18px;
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
<h2>Список юзеров</h2>

<form method="GET" action="{{ url()->current() }}" class="filter-form">
    <input
        type="text"
        name="search"
        placeholder="Поиск по имени, фамилии..."
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
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>

        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }} </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center; padding:20px;">
                    Данных нет
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>

</body>
</html>
@endsection
