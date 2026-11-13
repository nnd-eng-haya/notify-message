<?php

use Livewire\Component;

new class extends Component
{
    /**
     * ボタン押下イベント
     */
    public function onBtnClick(string $type)
    {
        logger("ボタンおされた");
        $msg = "";

        // メッセージタイプでメッセージを変える
        switch($type)
        {
            // 成功
            case 'success':
                $msg = "成功しました。";
            break;
            // エラー
            case 'error':
                $msg = "エラーが発生しました。";
            break;
            // ワーニング
            case 'warning':
                $msg = "ワーニングが発生しました。";
            break;
            // インフォ
            case 'info':
                $msg = "インフォメッセージです。";
            break;
            default:
                throw new Exception("不正なメッセージタイプです。");
        }
        // メッセージイベント送信
        $this->dispatch('notify',
            messageType: $type,
            message: $msg,
            link: ['url' => route('link'), 'text' => 'リンクをクリック'],
            duration: 3000
        );
    }
};
?>

<div class="flex items-center justify-center gap-2">
    <button type="button" wire:click="onBtnClick('success')" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        成功メッセージ
    </button>
    <button type="button" wire:click="onBtnClick('error')" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        エラーメッセージ
    </button>
    <button type="button" wire:click="onBtnClick('warning')" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        ワーニングメッセージ
    </button>
    <button type="button" wire:click="onBtnClick('info')" class="rounded px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        インフォメッセージ
    </button>
</div>
<!-- Geminiが生成したコード
<div x-data="{ show: false, message: '', timeout: null }"
    @notify.window="
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
-->
