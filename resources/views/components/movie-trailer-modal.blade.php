<div
    style="background-color: rgba(0, 0, 0, .7);"
    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
    x-show.transition.opacity="isOpen"
>
    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
        <div class="bg-gray-900 rounded">
            <div class="flex justify-end pr-4 pt-2">
                <button
                	@click="
                        isOpen = false
                        embedSrc = ''
                    "
                    @keydown.escape.window="
                        isOpen = false
                        embedSrc = ''
                    "
                    class="text-3xl leading-none hover:text-gray-300">&times;
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" :src="embedSrc" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

