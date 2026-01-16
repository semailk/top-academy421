@extends('layouts.app')

@section('content')

    <style>
        .trash-page {
            padding: 2rem 1rem;
            background: #f8fafc;
            min-height: 100vh;
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 1100px;
            margin: 0 auto;
        }
        .card-header {
            background: #f1f5f9;
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header h1 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            color: #1e293b;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .table th {
            background: #f8fafc;
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table tr:hover {
            background: #f1f5f9;
        }
        .author-name {
            font-weight: 600;
            color: #1e40af;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
            font-size: 1.1rem;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }
        .btn-restore {
            background: #10b981;
            color: white;
        }
        .btn-restore:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        .btn-back {
            background: #6b7280;
            color: white;
        }
        .btn-back:hover {
            background: #4b5563;
        }
    </style>

    <div class="trash-page">
        <div class="card">

            <div class="card-header">
                <h1>Корзина авторов (удалённые)</h1>
                <a href="{{ route('authors.index') }}" class="btn btn-back">← Назад к списку</a>
            </div>

            @if($authors->isEmpty())
                <div class="empty-state">
                    <p>В корзине пока нет удалённых авторов.</p>
                    <a href="{{ route('authors.index') }}" class="btn btn-back" style="margin-top:1.5rem;">Вернуться к активным авторам</a>
                </div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Дата рождения</th>
                        <th>Создан</th>
                        <th>Удалён</th>
                        <th style="width:140px; text-align:center;">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>
                                <div class="author-name">
                                    {{ $author->last_name }} {{ $author->first_name }} {{ $author->father_name ?? '' }}
                                </div>
                                <small style="color:#6b7280;">
                                    ID: {{ $author->id }} • {{ $author->gender === 'male' ? '♂' : ($author->gender === 'female' ? '♀' : '') }}
                                </small>
                            </td>
                            <td>
                                {{ $author->birth_date ? $author->birth_date->format('d.m.Y') : '—' }}
                            </td>
                            <td>{{ $author->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <strong style="color:#dc2626;">
                                    {{ $author->deleted_at->format('d.m.Y H:i') }}
                                </strong>
                            </td>
                            <td style="text-align:center;">
                                <form action="{{ route('authors.restore.patch', $author->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-restore"
                                            onclick="return confirm('Восстановить автора {{ $author->last_name }} {{ $author->first_name }} ?')">
                                        Восстановить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

@endsection
