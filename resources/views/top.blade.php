<x-layouts.app title="トップページ">
    <div class="space-y-2">
        <h1 class="flex items-center justify-center">イベント送信</h1>
        <livewire:livewire.update />
    </div>
    <div class="mt-10"></div>
    <div class="space-y-2">
        <h1 class="flex items-center justify-center">他ページにリダイレクト</h1>
        <div class="flex items-center justify-center gap-2">
            <form method="POST" action="{{ route('top.update') }}">
                @csrf

                <select name="type" class="px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded inline-flex items-center">
                    <option value="success">成功メッセージ</option>
                    <option value="error">エラーメッセージ</option>
                    <option value="warning">ワーニングメッセージ</option>
                    <option value="info">インフォメッセージ</option>
                </select>
                <button type="submit" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
                    POST後リダイレクト
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
