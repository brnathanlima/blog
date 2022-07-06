<x-panel>
    @auth
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="Avatar" width="40" height="40"
                    class="rounded-full">

                <h2 class="ml-4">Want to participate?</h2>
            </header>


            <x-form.field>
                <x-form.textarea
                    name="body"
                    class="text-sm focus:outline-none focus:ring"
                    placeholder="Quick, think of something to say!"
                />

                @error('body')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </x-form.field>

            <x-form.field class="flex justify-end border-t border-gray-200">
                <x-form.button>Post</x-form.button>
            </x-form.field>
        </form>
    @else
        <p class="font-semibold"><a href="/register" class="hover:underline">Register</a> or <a href="/login"
                class="hover:underline">Login</a> to leave a comment.</p>
    @endauth
</x-panel>
