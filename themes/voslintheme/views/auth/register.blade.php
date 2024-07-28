<x-app-layout>
    @if(config('settings::theme:enable-tawk') == 1)
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/{{ config('settings::theme:tawk-id', '#') }}/{{ config('settings::theme:tawk-widget-id', '#') }}';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    @endif

    <div class="content min-h-[50vh] flex items-center justify-center flex-col">
        <div class="flex items-center text-secondary-900 font-semibold text-lg py-4 gap-x-2">
            <x-application-logo class="w-10" />
            {{ config('app.name', 'Voslin') }}
        </div>
        <style>
            body {
                background-image: url("{{ config('settings::theme:bg-url', '#') }}");
                background-size: center;
                background-repeat: no-repeat; 
            }
        </style>
        <div class="content-box max-w-lg w-full">
            <form method="POST" action="{{ route('register') }}" id="register">
                @csrf

                <h2 class="text-lg font-semibold">{{ __('Make an Account') }}</h2>

                <x-input class="mt-3" label="{{ __('First name') }}" type="name" placeholder="{{ __('First name..') }}" required
                    name="first_name" id="first_name" icon="ri-user-3-line" />

                <x-input class="mt-3" label="{{ __('Last name') }}" type="name" placeholder="{{ __('Last name..') }}" required
                         name="last_name" id="last_name" icon="ri-user-3-line" />

                <x-input class="mt-3" label="{{ __('Email') }}" type="email" placeholder="{{ __('Email..') }}" required
                    name="email" id="email" icon="ri-at-line" />

                <x-input type="password" required class="mt-3" label="{{ __('Password') }}"
                    placeholder="{{ __('Password..') }}" name="password" id="password" icon="ri-lock-line"/>

                <x-input type="password" required class="mt-3" label="{{ __('Confirm Password') }}"
                    placeholder="{{ __('Password..') }}" name="password_confirmation" id="password-confirm" icon="ri-lock-password-line"/>

                <x-recaptcha form="register" />
                <div class="mt-3 flex justify-between items-center">
                    <a href="{{ route('login') }}" class="text-sm text-secondary-600 underline">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit" class="button button-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
