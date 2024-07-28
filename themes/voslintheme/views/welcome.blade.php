<x-app-layout title="home">
    <script>
        function removeElement(element) {
            element.remove();
            this.error = true;
        }
    </script>
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
    
    <x-success class="mt-4" />
    
    <style>
        body {
            background-image: url("{{ config('settings::theme:bg-url', '#') }}");
            background-size: center;
            background-repeat: no-repeat;
        }

        /* Features Style F1*/
        .f1 .uptime {
            background-color: white;
            color: #a8d160;
            padding: 20px;
            margin: 0px 0px 10px 0px;
            font-size: 30px;
            border-radius: 71% 29% 66% 34% / 52% 60% 40% 48% ;
            transition: all .5s;
        }
        .f1:hover .uptime {
            background-color: #a8d160;
            color: white;
            border-radius: 75% 25% 59% 41% / 29% 35% 65% 71% ;
            transition: all .5s;
        }
        /* Features Style F2 */
        .f2 .games {
            background-color: white;
            color: #7f2fa3;
            padding: 20px;
            margin: 0px 0px 10px 0px;
            font-size: 30px;
            border-radius: 48% 52% 26% 74% / 75% 60% 40% 25% ;
            transition: all .5s;
        }
        .f2:hover .games {
            background-color: #7f2fa3;
            color: white;
            border-radius: 71% 29% 66% 34% / 52% 60% 40% 48% ;
            transition: all .5s;
        }
        /* Features Style F3 */
        .f3 .payment {
            background-color: white;
            color: #d12159;
            padding: 20px;
            margin: 0px 0px 10px 0px;
            font-size: 30px;
            border-radius: 48% 52% 70% 30% / 75% 60% 40% 25% ;
            transition: all .5s;
        }
        .f3:hover .payment {
            background-color: #d12159;
            color: white;
            border-radius: 48% 52% 26% 74% / 75% 60% 40% 25% ;
            transition: all .5s;
        }
        /* Features Style F4 */
        .f4 .fastpanel {
            background-color: white;
            color: #21aed1;
            padding: 20px;
            margin: 0px 0px 10px 0px;
            font-size: 30px;
            border-radius: 75% 25% 59% 41% / 29% 35% 65% 71% ;
            transition: all .5s;
        }
        .f4:hover .fastpanel {
            background-color: #21aed1;
            color: white;
            border-radius: 48% 52% 70% 30% / 75% 60% 40% 25% ;
            transition: all .5s;
        }
    </style>

    @if (config('settings::home_page_text'))
        <div class="content ">
            <div class="content-box d-flex">
                <div style="align-items: center; display: flex; flex-direction: column;" class="prose dark:prose-invert min-w-full">
                    @markdownify(config('settings::home_page_text'))
                </div>
            </div>
        </div>
        <br><br>
    @endif
    @if(config('settings::theme:features') == 1)
    <div class="content">
        <h2 style="text-align: center;" class="font-semibold text-2xl mb-2 text-secondary-900">{{ __('FEATURES') }}</h2>
        <p style="text-align: center;">{{ config('settings::theme:features-info', 'Our Game Panel has a wide variety of features built-in') }}</p>
        <br>
        <div class="grid grid-cols-12 gap-4">

        <!-- Uptimes Features -->

        @if(config('settings::theme:uptime') == 1)
            <div class="lg:col-span-3 md:col-span-6 col-span-12 f1">
                <div class="content-box h-full flex flex-col">
                    <div class="content h-full flex flex-col">
                        <h2 style="text-align: center;" class="uptime"><i class="ri-hourglass-line"></i></h2>
                    </div>
                    <br>
                    <h3 style="text-align: center;" class="font-semibold text-lg">{{ config('settings::theme:uptime-name', '99.99% Uptime') }}</h3>
                    <br>
                    <p style="text-align: center;">{{ config('settings::theme:uptime-des', 'With 99.99% uptime you know your server is never offline.') }}</p>
                    <br>
                </div>
            </div>
        @endif

        <!-- Games Features -->

        @if(config('settings::theme:games') == 1)
            <div class="lg:col-span-3 md:col-span-6 col-span-12 f2">
                <div class="content-box h-full flex flex-col">
                    <div class="content h-full flex flex-col">
                        <h2 style="text-align: center;" class="games"><i class="ri-gamepad-line"></i></h2>
                    </div>
                    <br>
                    <h3 style="text-align: center;" class="font-semibold text-lg">{{ config('settings::theme:games-name', 'Game Support') }}</h3>
                    <br>
                    <p style="text-align: center;">{{ config('settings::theme:games-des', 'We support Minecraft, Rust, Terraria and any order game you can think!') }}</p>
                    <br>
                </div>
            </div>
        @endif

        <!-- Payment Features -->

        @if(config('settings::theme:payment') == 1)
            <div class="lg:col-span-3 md:col-span-6 col-span-12 f3">
                <div class="content-box h-full flex flex-col">
                    <div class="content h-full flex flex-col">
                        <h2 style="text-align: center;" class="payment"><i class="ri-bank-card-line"></i></h2>
                    </div>
                    <br>
                    <h3 style="text-align: center;" class="font-semibold text-lg">{{ config('settings::theme:payment-name', 'Payment Methods') }}</h3>
                    <br>
                    <p style="text-align: center;">{{ config('settings::theme:payment-des', 'Voslin supports Paypal, Stripe and Cryptocurrency!') }}</p>
                    <br>
                </div>
            </div>
        @endif

        <!-- Blazing Fast Panel -->

        @if(config('settings::theme:fastpanel') == 1)
            <div class="lg:col-span-3 md:col-span-6 col-span-12 f4">
                <div class="content-box h-full flex flex-col">
                    <div class="content h-full flex flex-col">
                        <h2 style="text-align: center;" class="fastpanel"><i class="ri-terminal-box-line"></i></h2>
                    </div>
                    <br>
                    <h3 style="text-align: center;" class="font-semibold text-lg">{{ config('settings::theme:fastpanel-name', 'Fast Panel') }}</h3>
                    <br>
                    <p style="text-align: center;">{{ config('settings::theme:fastpanel-des', 'Our panel is the fastest panel available.') }}</p>
                    <br>
                </div>
            </div>
        @endif

        </div>
    </div>
    <br><br><br><br><br>
    @endif

    @if ($categories->count() > 0)
        <div class="content">
            <h2 style="text-align: center;" class="font-semibold text-2xl mb-2 text-secondary-900">{{ __('PLAN') }}</h2>
            <p style="text-align: center;">{{ config('settings::theme:info_plan_des', 'Select the game you wish to see plans for') }}</p>
            <br>
            <div class="grid grid-cols-12 gap-4">
                @foreach ($categories as $category)
                    @if ($category->products->count() > 0)
                        <div class="lg:col-span-3 md:col-span-6 col-span-12">
                            <div class="content-box h-full flex flex-col">
                                <h3 style="text-align: center;" class="font-semibold text-lg">{{ $category->name }}</h3>
                                <br>
                                <h4>{{ $category->description }}</h4>
                                <br>
                                <div class="pt-3 mt-auto">
                                    <style>
                                        .voslin:hover {
                                            border-radius: 50px 0px 50px 0px;
                                            transition: .2s;
                                        }
                                    </style>
                                    <a href="{{ route('products', $category->slug) }}"
                                    class="button button-secondary w-full voslin">{{ config('settings::theme:order-text', 'ORDER') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    @endif

    <!-- register bar -->
    @auth
        <br>
    @else
        <br><br><br><br><br>
        <div class="content">
            <div class="content-box h-full flex flex-col">
                <h5 style="text-align: center;" class="font-semibold text-lg">Register Now</h5>
                <h2 style="text-align: center;">Register your account and get your server up and running in no-time!</h2>
                <br>
                <div class="content h-full flex flex-col">
                    <a href="{{ route('register') }}" class="button button-secondary">Create Account</a>
                </div>
            </div>
        </div>
    @endauth

    <!-- About Us -->

</x-app-layout>