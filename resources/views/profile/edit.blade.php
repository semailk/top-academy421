@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мой профиль') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Сообщение об успехе -->
            @if (session('status'))
                <div class="rounded-lg bg-green-50 border-l-4 border-green-500 p-4 text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <!-- 1. Обновление информации профиля -->
            <div class="bg-white shadow sm:rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Информация профиля') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Обновите имя, email и фото профиля вашего аккаунта.') }}
                    </p>
                </div>

                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- 2. Смена пароля -->
            <div class="bg-white shadow sm:rounded-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Смена пароля') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Убедитесь, что ваш аккаунт использует длинный, случайный пароль для безопасности.') }}
                    </p>
                </div>

                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- 3. Удаление аккаунта -->
            <div class="bg-white shadow sm:rounded-xl overflow-hidden border-t-4 border-red-200">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-red-800">
                        {{ __('Удалить аккаунт') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('После удаления аккаунта все его ресурсы и данные будут безвозвратно удалены.') }}
                    </p>
                </div>

                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
@endsection
