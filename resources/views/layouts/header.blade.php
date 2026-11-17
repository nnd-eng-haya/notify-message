<header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- ロゴ & ブランド -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 text-indigo-400 hover:text-indigo-300 transition-colors">
                    <span class="font-bold text-xl tracking-tight text-white">{{ config('app.name', 'Laravel') }}</span>
                </a>

                {{-- ナビゲーションリンク --}}
                <nav class="hidden md:flex ml-8 space-x-2">
                    <a href="{{ url('/top') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('playlist*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        トップページ
                    </a>
                    <a href="{{ url('/simple') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->is('playlist*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        シンプルなメッセージ通知
                    </a>
                </nav>
            </div>

        </div>
    </div>
</header>

