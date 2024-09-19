<nav class="bg-secondary-50 dark:bg-secondary-100 dark:border-0 border-b-2 border-secondary-200">
    <div class="max-w-[1650px] mx-auto block md:flex items-center gap-x-10 px-5">
        <div class="flex justify-between md:w-auto w-full items-center">
            <a href="{{ route('index') }}" class="flex items-center text-secondary-900 font-semibold text-lg py-2 gap-x-2 w-max">
                <x-application-logo class="w-10" />
                {{ config('app.name', 'Voslin') }}
            </a>
            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button type="button" class="button button-secondary-outline" onclick="openMobileMenu()">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <script>
                function openMobileMenu() {
                    document.getElementById("mobile-menu").classList.toggle("hidden");
                    document.getElementById("clientsNavBar").classList.toggle("hidden");
                }
            </script>
        </div>
        <div class="w-full justify-between gap-x-5 md:px-5 md:flex hidden" id="mobile-menu">
            <a href="{{ route('index') }}"
                class="md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                <i class="ri-home-4-line"></i> {{ __('Home') }}
            </a>
            @auth 
                <a href="{{ route('clients.home') }}"
                    class="md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                    <i class="ri-dashboard-line"></i> {{ __('Dashboard') }}
                </a>
            @endauth
            <button type="button" aria-expanded="true" data-dropdown-placement="bottom-start" aria-haspopup="true"
                data-dropdown-toggle="orders"
                class="relative md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                <i class="ri-server-line"></i> {{ __('Services') }} <i class="ri-arrow-down-s-line"></i>

                <div class="absolute left-0 hidden w-56 mt-2 origin-top-right bg-secondary-200 border border-secondary-300 rounded-md z-10"
                    role="menu" aria-orientation="vertical" aria-labelledby="product" tabindex="-1" id="orders">
                    @foreach (App\Models\Category::withCount('products')->orderBy('order')->get() as $category)
                        @if ($category->products_count > 0)
                            <a href="{{ route('products', $category->slug) }}"
                                class="flex px-4 py-2 rounded text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900"
                                role="menuitem" tabindex="-1" id="menu-item-0">{{ $category->name }}</a>
                        @endif
                    @endforeach
                </div>

            </button>
            <a href="{{ route('announcements.index') }}"
                class="md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                <i class="ri-megaphone-line @if (request()->routeIs('announcements.index')) text-primary-400 @endif"></i> {{ __('Announcements') }}
            </a>
            @if(config('settings::theme:panel') == 1)
            <a href="{{ config('settings::theme:panel-url', '#') }}"
                class="md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                <i class="ri-window-line"></i> {{ __('Panel') }}
            </a>
            @endif
            <button type="button" aria-expanded="true" data-dropdown-placement="bottom-start" aria-haspopup="true"
                data-dropdown-toggle="support"
                class="relative md:px-2 py-3 flex items-center gap-x-1 hover:text-secondary-800 duration-300">
                <i class="ri-customer-service-2-line @if (request()->routeIs('clients.tickets*')) text-primary-400 @endif"></i> {{ __('Support') }} <i class="ri-arrow-down-s-line"></i>

                <div class="absolute left-0 hidden w-56 mt-2 origin-top-right bg-secondary-200 border border-secondary-300 rounded-md z-10"
                    role="menu" aria-orientation="vertical" aria-labelledby="product" tabindex="-1" id="support">
                    <a href="{{ route('clients.tickets.index') }}"
                        class="flex px-4 py-2 rounded text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900"
                        role="menuitem" tabindex="-1" id="menu-item-0">{{ __('Tickets') }}</a>
                    @if(config('settings::theme:discord-sp') == 1)
                    <a href="{{ config('settings::theme:discord-url', '#') }}"
                        class="flex px-4 py-2 rounded text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900"
                        role="menuitem" tabindex="-1" id="menu-item-0">{{ __('Discord Support') }}</a>
                    @endif
                    @if(config('settings::theme:telegram-sp') == 1)
                    <a href="{{ config('settings::theme:telegram-url', '#') }}"
                        class="flex px-4 py-2 rounded text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900"
                        role="menuitem" tabindex="-1" id="menu-item-0">{{ __('Telegram Support') }}</a>
                    @endif
                </div>

            </button>
            <div class="ml-auto flex items-center gap-x-1 justify-center md:pb-0 pb-4">
                @if (count(session()->get('cart', [])) > 0)
                    <a href="{{ route('checkout.index') }}" class="button button-secondary-outline !font-normal">
                        <i class="ri-shopping-cart-line"></i>
                        {{ count(session()->get('cart')) }}
                    </a>
                @endif
                @if (config('settings::sidebar') == 0)
                    <button class="py-1 float-right button button-secondary-outline !font-normal" id="theme-toggle">
                        <i class="ri-sun-line hidden dark:block"></i>
                        <i class="ri-moon-line dark:hidden"></i>
                    </button>
                    <script>
                        // Change the icons inside the button based on previous settings
                        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                            '(prefers-color-scheme: dark)').matches));

                        var themeToggleBtn = document.getElementById('theme-toggle');
                        themeToggleBtn.addEventListener('click', function() {
                            // if set via local storage previously
                            if (localStorage.getItem('theme')) {
                                if (localStorage.getItem('theme') === 'light') {
                                    document.documentElement.classList.add('dark');
                                    localStorage.setItem('theme', 'dark');
                                } else {
                                    document.documentElement.classList.remove('dark');
                                    localStorage.setItem('theme', 'light');
                                }
                                // if NOT set via local storage previously
                            } else {
                                if (document.documentElement.classList.contains('dark')) {
                                    document.documentElement.classList.remove('dark');
                                    localStorage.setItem('theme', 'light');
                                } else {
                                    document.documentElement.classList.add('dark');
                                    localStorage.setItem('theme', 'dark');
                                }
                            }
                        });
                    </script>
                @endif
                @auth
                    <button type="button" aria-expanded="true" aria-haspopup="true" data-dropdown-placement="bottom-end"
                            data-dropdown-toggle="account" class="relative md:flex-none flex-1">
                        <div class="inline-flex items-center justify-center">
                            <img class="w-8 h-8 rounded-md" src="https://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=200&d=mp" alt="Avatar"/>
                            <p class="p-2 font-bold">
                                {{ Auth::user()->first_name }}
                            </p>
                        </div>
                        <div class="absolute left-0 hidden w-60 mt-2 origin-top-right bg-secondary-200 border border-secondary-300 rounded-md text-secondary-700 font-normal text-start z-10"
                             role="menu" aria-orientation="vertical" aria-labelledby="product" tabindex="-1" id="account">
                            <div class="px-2 py-2">

                                <a href="{{ route('clients.profile') }}" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out">
                                    <i class="ri-account-circle-line"></i> {{__('Profile')}}
                                </a>
                                <a href="{{ route('clients.credits') }}" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out">
                                    <i class="ri-money-dollar-circle-line"></i> {{__('Credit')}}
                                </a>
                                <a href="{{ route('clients.home') }}" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out">
                                    <i class="ri-dashboard-line"></i> {{__('Dashboard')}}
                                </a>

                                {{-- <a href="#" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded"><i class="ri-instance-line"></i> {{ __('Services') }}</a> --}}

                                @if (Auth::user()->has('ADMINISTRATOR'))

                                    <hr class="mx-2 my-1 border-secondary-400" />

                                    <a href="{{ route('admin.index') }}" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out">
                                        <i class="ri-key-2-line"></i> {{ __('Admin area') }}
                                    </a>
                                    <a href="{{ route('clients.api.index') }}" class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out">
                                        <i class="ri-code-s-slash-line"></i> {{ __('API') }}
                                    </a>
                                @endif

                                <hr class="mx-2 my-1 border-secondary-400" />

                                <a type="button" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                   class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded transition-all ease-in-out"
                                >
                                    <i class="ri-logout-box-line"></i> {{ __('Log Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="button button-primary md:flex-none flex-1">
                        {{ __('Log In') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
