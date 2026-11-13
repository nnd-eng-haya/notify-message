<div x-data="alpineData"
    x-show="show"
    x-init="
        @if(session('success'))
            triggerSession('success', '{{ session('success') }}', '{{ session('linkUrl') }}', '{{ session('linkText') }}', '{{ session('duration') }}')
        @elseif(session('error'))
            triggerSession('error', '{{ session('error') }}', '{{ session('linkUrl') }}', '{{ session('linkText') }}', '{{ session('duration') }}')
        @elseif(session('warning'))
            triggerSession('warning', '{{ session('warning') }}', '{{ session('linkUrl') }}', '{{ session('linkText') }}', '{{ session('duration') }}')
        @elseif(session('info'))
            triggerSession('info', '{{ session('info') }}', '{{ session('linkUrl') }}', '{{ session('linkText') }}', '{{ session('duration') }}')
        @endif
    "
    @notify.window="
    console.dir($event.detail);
        triggerEvent($event.detail.messageType, $event.detail.message, $event.detail.link, $event.detail.duration);
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
        console.log("Init");
        Alpine.data('alpineData', () => ({
            show: false,
            msgType: '',
            message: '',
            addLink: [],
            duration: 0,
            timeout: null,
            showMessage() {
                this.show = true;
                if(this.duration > 0) {
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => { this.show = false }, this.duration);
                }
            },
            triggerSession(type, msg, url, text, duration) {
                console.log("triggerSession");
                this.msgType = type;
                this.message = msg;
                this.addLink = {url: url, text: text};
                this.duration = duration;
                this.showMessage();
            },
            triggerEvent(type, msg, link, duration) {
                console.log("triggerEvent");
                this.msgType = type;
                this.message = msg;
                this.addLink = link;
                this.duration = duration;
                this.showMessage();
            }
        }));
    });
</script>
@script