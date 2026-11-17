<?php

use Livewire\Attributes\On;
use Livewire\Component;

/**
 * メッセージを表示するイベントをAlpine.jsに送信するコンポーネント
 */
new class extends Component
{
    // メッセージタイプ
    public string $messageType = "";
    // メッセージ
    public string $message = "";
    // 表示色class
    public string $colorClass = "";
    // リンク情報
    public array $messageLink = [];
    // 表示時間
    public int $duration;

    // 表示フラグ
    public bool $isShow = false;
   
    /**
     * 通知イベント処理
     */
    #[On('notify')]
    public function onReceiveNotify(string $messageType, string $message, array $link = [], int $duration = 0)
    {
        // パラメータ保存
        $this->messageType = $messageType;
        $this->message = $message;
        $this->messageLink = $link;
        $this->duration = $duration;

        // メッセージタイプでclass変える
        if($messageType === 'success')
        {
            // success
            $this->colorClass = "bg-green-950/50 border-green-800 text-green-300";
        }
        elseif($messageType === 'error')
        {
            // error
            $this->colorClass = "bg-rose-950/50 border-rose-800 text-rose-300";
        }
        elseif($messageType === 'warning')
        {
            // warning
            $this->colorClass = "bg-yellow-950/50 border-yellow-800 text-yellow-300";
        }
        elseif($messageType === 'info')
        {
            // info
            $this->colorClass = "bg-blue-950/50 border-blue-800 text-blue-300";
        }

        // メッセージ表示
        $this->isShow = true;

        // 表示イベント送信
        $this->dispatch('show_message');
    }
};
?>

<div x-data="{
        show: false,
        timeout: null
    }"
    @show_message.window="
        console.log('show_message event raised in components/livewire/message.blade.php.');
        show = true;
        // 表示時間が設定されている場合のみタイムアウト処理
        if(@js($duration) > 0) {
            clearTimeout(timeout);
            timeout = setTimeout(() => { show = false }, @js($duration));
        }
    "
    x-show="show"
    x-transition.opacity.duration.500ms
    class="border rounded-lg p-2 text-sm {{ $this->colorClass }}"
>
    {{ $this->message }}
    @if($this->messageLink)
        <a href="{{ $this->messageLink['url'] }}" class="underline text-indigo-400 hover:text-indigo-300 ml-2 font-medium">
            {{ $this->messageLink['text'] }}
        </a>
    @endif
</div>
