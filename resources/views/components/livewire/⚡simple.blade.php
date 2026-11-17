<?php

use Livewire\Component;

/**
 * シンプルなメッセージイベントでメッセージ表示するコンポーネント
 */
new class extends Component
{
    /**
     * ボタン押下イベント
     */
    public function onBtnClick()
    {
        $msg = "イベントから送信したメッセージテキスト";

        // メッセージイベント送信
        $this->dispatch('simple', message: $msg);
    }
};
?>

<div>
    <div class="flex items-center justify-center gap-2">
        <button type="button" wire:click="onBtnClick" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
            メッセージイベント発火
        </button>
    </div>
    <div class="mt-10"></div>
    <div class="flex items-center justify-center gap-2">
        {{-- イベント受信して内容を表示(3secで消える) --}}
        <div x-data="{ show: false, message: '', timeout: null }"
            @simple.window="
                message = $event.detail.message;
                show = true;
                clearTimeout(timeout);
                timeout = setTimeout(() => { show = false }, 3000);
            "
            x-show="show"
            x-transition.opacity.duration.500ms
            style="display: none;"
            class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
            <span x-text="message"></span>
        </div>
    </div>
</div>
