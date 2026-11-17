<?php

use Livewire\Component;

/**
 * メッセージ表示イベントを発火するコンポーネント
 */
new class extends Component
{
    /**
     * ボタン押下イベント
     */
    public function onBtnClick(string $type)
    {
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
        logger("イベント送信:");
        logger("    メッセージ種別　: {$type}");
        logger("    メッセージ　　　: {$msg}");
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
    <button type="button" wire:click="onBtnClick('success')" class="px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        成功メッセージ
    </button>
    <button type="button" wire:click="onBtnClick('error')" class="px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        エラーメッセージ
    </button>
    <button type="button" wire:click="onBtnClick('warning')" class="px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        ワーニングメッセージ
    </button>
    <button type="button" wire:click="onBtnClick('info')" class="px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-200 cursor-pointer">
        インフォメッセージ
    </button>
</div>
