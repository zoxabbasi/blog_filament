<div>
    {{-- Using jQuery to add showing and hidding submit and cancel button on focus --}}
    <div x-data="{
        focused: false,
        isEdit: {{ $commentModel ? 'true' : 'false' }},
        init(){
            if (this.isEdit)
                this.$refs.input.focus()
                {{-- AlpineJs syntax to set autofocus to input field --}}
            $wire.on('commentCreated', () => {
                this.focused = false;
            })
            {{-- This will be called whenever the event in initialised --}}
        }
    }" class="mb-4">
        <div class="mb-2">
            {{-- {{ $comment }} --}}
            {{-- This is for two way binding of data --}}
            <textarea
                x-ref="input"
                {{-- AlpineJs syntax --}}
                wire:model="comment"
                @click="focused = true"
                placeholder="Leave a comment"
                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                {{-- If textarea is focused then display 4 rows orelse display 1 row --}}
                :rows="isEdit || focused ? '2' : '1'"></textarea>
        </div>
        <div :class="isEdit || focused ? '' : 'hidden'">
            <button
                wire:click="createComment"
                class="rounded-md bg-blue-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-offset-2 focus-visible:outline-blue-600 mr-3">Submit
            </button>
            <button
                @click="focused = false; isEdit = false;  $wire.emitUp('cancelEditing')"
                type="button"
                class="rounded-m px-3.5 py-2.5 text-center text-sm font-semibold text-black shadow-sm focus-visible:outline-offset-2 focus-visible:outline-blue-600 border-1">Cancel
            </button>
        </div>
    </div>

</div>
