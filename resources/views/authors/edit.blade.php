@extends('layouts.app')

@section('content')

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --success-dark: #15803d;
            --danger: #dc2626;
            --danger-dark: #b91c1c;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-600: #4b5563;
            --gray-900: #111827;
        }

        .edit-page {
            min-height: 100vh;
            background: linear-gradient(to bottom, #f8fafc, #f1f5f9);
            padding: 2.5rem 1rem;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .form-card {
            max-width: 720px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .form-header {
            padding: 1.5rem 2rem;
            background: linear-gradient(to right, #f8fafc, #f1f5f9);
            border-bottom: 1px solid var(--gray-200);
        }

        .form-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .form-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: #374151;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: all 0.2s ease;
            background: white;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
        }

        .checkbox-group input[type="checkbox"] {
            width: 1.25rem;
            height: 1.25rem;
            accent-color: var(--primary);
        }

        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
        }

        .btn-save {
            background: var(--success);
            color: white;
        }

        .btn-save:hover {
            background: var(--success-dark);
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: var(--gray-200);
            color: var(--gray-900);
        }

        .btn-cancel:hover {
            background: #d1d5db;
            transform: translateY(-1px);
        }

        .delete-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #fee2e2;
            background: #fef2f2;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .btn-delete {
            background: var(--danger);
            color: white;
            width: 100%;
            max-width: 240px;
        }

        .btn-delete:hover {
            background: var(--danger-dark);
            transform: translateY(-1px);
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @if(session('success'))
        <div class="alert alert-success" style="max-width:720px; margin:0 auto 1.5rem; padding:1rem; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="max-width:720px; margin:0 auto 1.5rem; padding:1rem; border-radius:8px;">
            <ul style="margin:0; padding-left:1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="edit-page">
        <div class="form-card">
            <div class="form-header">
                <h2>Редактирование автора</h2>
            </div>

            <div class="form-body">
                <form method="POST" action="{{ route('authors.update', $author->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Имя</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $author->first_name) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Фамилия</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $author->last_name) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Отчество</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $author->father_name) }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Дата рождения</label>
                            <input type="date" name="birth_date"
                                   value="{{ old('birth_date', $author->birth_date?->format('Y-m-d')) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Пол</label>
                            <select name="gender">
                                <option value="male"   @selected(old('gender', $author->gender()) == 'Male')>Мужской</option>
                                <option value="female" @selected(old('gender', $author->gender()) == 'Female')>Женский</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Биография</label>
                        <textarea name="biography" placeholder="Расскажите о себе или об авторе...">{{ old('biography', $author->biography) }}</textarea>
                    </div>

                    @if($author->user_id == auth()->id() || auth()->user()?->isAdmin())
                        <div class="checkbox-group">
                            <input type="checkbox" name="active" value="1" @checked(old('active', $author->active) == 1 || old('active') === null && $author->active)>
                            <label>Активен (отображается публично)</label>
                        </div>

                        <div class="actions">
                            <button type="submit" class="btn btn-save">Сохранить изменения</button>
                            <a href="{{ route('authors.index') }}" class="btn btn-cancel">Отмена</a>
                        </div>
                    @endif
                </form>

                <div class="delete-section">
                    <form method="POST" action="{{ route('authors.destroy', $author->id) }}"
                          onsubmit="return confirm('Вы действительно хотите удалить этого автора?\n\nЭто действие нельзя отменить!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Удалить автора</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
