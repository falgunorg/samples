<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 alert alert-info py-2 px-3 small border-0" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-100" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="w-100"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label text-secondary small user-select-none">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Form Actions -->
        <div class="d-flex align-items-center justify-content-between pt-1">
            @if (Route::has('password.request'))
            <a class="text-decoration-underline text-muted small" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>