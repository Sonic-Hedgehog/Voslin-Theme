<x-app-layout clients>
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
    <div class="min-h-[50vh] flex items-center justify-center flex-col">
        <style>
            body {
                background-image: url("{{ config('settings::theme:bg-url', '#') }}");
                background-size: center;
                background-repeat: no-repeat; 
            }
        </style>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg content-box">
            <div class="mb-4 text-sm">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="button button-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="text-sm underline">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
