<div x-data="alpineData"
    x-show="show"
    {{-- [1]パラメータをバラで受け取る --}}
{{--
    x-init="
        @if(session('success'))
            triggerSessionSeparate('success', '{{ session('success') }}', '{{ session('link') }}', '{{ session('duration') }}')
        @elseif(session('error'))
            triggerSessionSeparate('error', '{{ session('error') }}', '{{ session('link') }}', '{{ session('duration') }}')
        @elseif(session('warning'))
            triggerSessionSeparate('warning', '{{ session('warning') }}', '{{ session('link') }}', '{{ session('duration') }}')
        @elseif(session('info'))
            triggerSessionSeparate('info', '{{ session('info') }}', '{{ session('link') }}', '{{ session('duration') }}')
        @endif
    "
--}}
    {{-- [2]パラメータをまとめて受け取る --}}
    x-init="
        @if(session('message'))
            triggerSessionAll('{{ session('message') }}')
        @endif
    "
    @notify.window="
        console.log('notify event raised in components/message.blade.php.');
        console.dir($event.detail);

        triggerEvent($event.detail);
    "
    x-transition.opacity.duration.500ms
>
    <template x-if="msgType == 'success'">
        <div class="bg-green-950/50 border border-green-800 rounded-lg p-2 text-green-300 text-sm">
            <span x-text="message"></span>
            <template x-if="addLink">
                <a :href="addLink['url']" x-text="addLink['text']" class="underline text-indigo-400 hover:text-indigo-300 ml-2 font-medium"></a>
            </template>
        </div>
    </template>
    <template x-if="msgType == 'error'">
        <div class="bg-rose-950/50 border border-rose-800 rounded-lg p-2 text-rose-300 text-sm">
            <span x-text="message"></span>
            <template x-if="addLink">
                <a :href="addLink['url']" x-text="addLink['text']" class="underline text-indigo-400 hover:text-indigo-300 ml-2 font-medium"></a>
            </template>
        </div>
    </template>
    <template x-if="msgType == 'warning'">
        <div class="bg-yellow-950/50 border border-yellow-800 rounded-lg p-2 text-yellow-300 text-sm">
            <span x-text="message"></span>
            <template x-if="addLink">
                <a :href="addLink['url']" x-text="addLink['text']" class="underline text-indigo-400 hover:text-indigo-300 ml-2 font-medium"></a>
            </template>
        </div>
    </template>
    <template x-if="msgType == 'info'">
        <div class="bg-blue-950/50 border border-blue-800 rounded-lg p-2 text-blue-300 text-sm">
            <span x-text="message"></span>
            <template x-if="addLink">
                <a :href="addLink['url']" x-text="addLink['text']" class="underline text-indigo-400 hover:text-indigo-300 ml-2 font-medium"></a>
            </template>
        </div>
    </template>
</div>

@script
<script>
    document.addEventListener('alpine:init', () => {
        console.log("Alpine init.");
        Alpine.data('alpineData', () => ({
            show: false,
            msgType: '',
            message: '',
            addLink: null,
            duration: 0,
            timeout: null,
            /**
             * メッセージ表示処理とタイムアウト設定
             */
            showMessage() {
                this.show = true;
                // 表示時間が設定されている場合のみタイムアウト処理
                if(this.duration > 0) {
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => { this.show = false }, this.duration);
                }
            },
            /**
             * バラのセッションメッセージ表示処理
             * @param   string type     メッセージ種別
             * @param   string msg      メッセージテキスト
             * @param   string linkJson リンクURL+表示テキストのJSON文字列
             * @param   string duration 表示時間(ms)
             */
            triggerSessionSeparate(type, msg, linkJson, duration) {
                console.log("triggerSessionSeparate");
                console.log("durationの型:" + typeof duration);
                // パラメータ設定
                this.msgType = type;
                this.message = msg;
                this.addLink = JSON.parse(linkJson); // オブジェクト変換
                this.duration = Number(duration);
                // メッセージ表示
                this.showMessage();
            },
            /**
             * まとめてのセッションメッセージ表示処理
             * @param   string paramJsonStr パラメータのJSON文字列
             */
            triggerSessionAll(paramJsonStr) {
                console.log("triggerSessionAll");
                // オブジェクト変換
                const json = JSON.parse(paramJsonStr);
                console.log("durationの型:" + typeof json.duration);
                // パラメータ設定
                this.msgType = json.messageType;
                this.message = json.message;
                this.addLink = json.link;
                this.duration = json.duration;
                // メッセージ表示
                this.showMessage();
            },
            /**
             * イベントメッセージ表示処理
             * @param   object eventDetail  $event.detailオブジェクト
             */
            triggerEvent(eventDetail) {
                console.log("triggerEvent");
                console.log("durationの型:" + typeof eventDetail.duration);
                // パラメータ設定
                this.msgType = eventDetail.messageType;
                this.message = eventDetail.message;
                this.addLink = eventDetail.link;        // イベントはオブジェクトのまま来る
                this.duration = eventDetail.duration;
                // メッセージ表示
                this.showMessage();
            }
        }));
    });
</script>
@script