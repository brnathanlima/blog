<x-layout>
    <main class="max-w-lg mx-auto mt-10">
        <x-panel>
            <h1 class="text-center font-bold text-xl">Login</h1>
            <form action="{{ route('login') }}" method="post" class="mt-10">
                @csrf

                <x-form.input name="email" type="email" aria-autocomplete="username" autocomplete="username"></x-form-input>
                <x-form.input name="password" type="password" aria-autocomplete="current-password" autocomplete="current-password"></x-form-input>
                <x-form.button>Log In</x-form.button>
            </form>
        </x-panel>
    </main>
</x-layout>
