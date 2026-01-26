<!-- Header / Navbar -->
<header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between flex-wrap gap-4">

            <!-- Логотип -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 shrink-0">
                <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow">
                    A
                </div>
                <span class="text-xl font-bold text-gray-900">{{ mb_ucfirst(last(explode('/', request()->path()))) }}</span>
            </a>

            <!-- Основные ссылки (переносятся на мобильных) -->
            <div class="flex items-center gap-5 sm:gap-6 md:gap-8 flex-wrap justify-end">
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition text-sm sm:text-base">
                    @lang('header.dashboard')
                </a>

                <a href="{{ route('authors.index') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition text-sm sm:text-base">
                    @lang('header.authors')
                </a>

                <a href="{{ route('books.index') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition text-sm sm:text-base">
                    @lang('header.books')
                </a>

                    <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-indigo-700 font-medium transition text-sm sm:text-base">
                        @lang('header.users')
                    </a>

                <a href="{{ route('authors.restore') }}" class="text-rose-600 hover:text-rose-800 font-medium transition flex items-center gap-1.5 text-sm sm:text-base">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    @lang('header.trashed')
                </a>
            </div>

            <!-- Пользователь + Выйти -->
            <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                <div class="hidden sm:flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-sm">
                        {{ mb_substr(auth()->user()->name ?? '?', 0, 1) }}
                    </div>
                    <span class="text-gray-800 font-medium text-sm">
                        {{ auth()->user()->name ?? 'Пользователь' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg border border-red-200 hover:border-red-300 transition">
                        @lang('header.logout')
                    </button>
                </form>
            </div>
            @if(app()->getLocale() == 'en')
                    <a href="/lang/ru">RU</a>
            @else
                    <a href="/lang/en">EN</a>
            @endif
        </div>
    </nav>
</header>
