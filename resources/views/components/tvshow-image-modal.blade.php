<div
    style="background-color: rgba(0, 0, 0, .7);"
    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
    x-show.transition.opacity="imageOpen"
>
    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
        <div class="bg-gray-900 rounded">
            <div class="flex justify-end pr-4 pt-2">
                <button
                    @click="imageOpen = false"
                    @keydown.escape.window="imageOpen = false"
                    class="text-3xl leading-none hover:text-gray-300">&times;
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                <div class="responsive-container overflow-hidden relative">
                    <img class="object-contain" :src="image" alt="poster">
                </div>
            </div>
        </div>
    </div>
</div>

