@if (config('settings::sidebar') == 0)
    <div style="display: flex;flex-direction: row;justify-content: center;" class="bg-secondary-50 dark:bg-secondary-100 dark:border-0 dark:border-t-2 border-b-2 md:block border-secondary-200 hidden" id="clientsNavBar">
        <div class="max-w-[1650px] mx-auto block md:flex items-center gap-x-10 px-5">
            <a href="{{ route('clients.home') }}" class="md:px-2 py-3 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-layout-2-line @if (request()->routeIs('clients.home')) text-primary-400 @endif"></i> {{ __('Dashboard') }}
            </a>
            <a href="{{ route('clients.invoice.index') }}" class="md:px-2 py-3 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-file-paper-line @if (request()->routeIs('clients.invoice*')) text-primary-400 @endif"></i> {{ __('Invoices') }}
            </a>
            <a href="{{ route('clients.tickets.index') }}" class="md:px-2 py-3 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-customer-service-2-line @if (request()->routeIs('clients.tickets*')) text-primary-400 @endif"></i> {{ __('Tickets') }}
            </a>
            <a href="{{ route('clients.profile') }}" class="md:px-2 py-3 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-user-6-line @if (request()->routeIs('clients.profile')) text-primary-400 @endif"></i> {{ __('Profile Settings') }}
            </a>
        </div>
    </div>
@else
    <div class="max-w-[1650px] flex-wrap items-center w-full justify-between flex md:hidden px-4 py-4" id="mobile-menu">
        <a href="{{ route('index') }}" class="flex items-center text-secondary-900 font-semibold text-lg gap-x-2">
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
                document.getElementById("mobile-menu").classList.toggle("opacity-0");
                document.getElementById("clientsNavBar").classList.toggle("hidden");
            }
        </script>
    </div>
    <style>
        .py-1 {
            padding: 10px 12px 10px 10px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 510;
            transition: all .2s;
        }
        .py-1:hover {
            background: #00000250;
        }
        #clientsNavBar {
            animation: all .2s;
        }
    </style>
    <div class="shrink-0 md:w-62 w-72 hidden sm:block md:sticky fixed top-0" id="clientsNavBar">
        <div class="bg-secondary-50 dark:bg-secondary-100 dark:border-0 border-r-2 border-secondary-200 h-screen sticky top-0 px-4 py-2 flex flex-col">
            <div style="display: flex; flex-direction: column;" class=" flex flex-wrap items-center w-full justify-between">
                <a href="{{ route('index') }}" class="flex items-center text-secondary-900 font-semibold text-lg py-2 gap-x-2">
                    <x-application-logo class="w-10" />
                    {{ config('app.name', 'Voslin') }}
                </a>
            </div>
            <span class="text-sm text-secondary-600">General</span>
            <a href="{{ route('index') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-home-4-line @if (request()->routeIs('index*')) text-primary-400 @endif"></i> {{ __('Home') }}
            </a>
            <a href="{{ route('announcements.index') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-megaphone-line "></i> {{ __('Announcements') }}
            </a>
            <br>
            <span class="text-sm text-secondary-600 mt-3">Dashboard</span>
            <a href="{{ route('clients.home') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-dashboard-line @if (request()->routeIs('clients.home*')) text-primary-400 @endif"></i> {{ __('Dashboard') }}
            </a>
            <a href="{{ route('clients.invoice.index') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-file-paper-line @if (request()->routeIs('clients.invoice*')) text-primary-400 @endif"></i> {{ __('Invoices') }}
            </a>
            <a href="{{ route('clients.tickets.index') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-customer-service-2-line @if (request()->routeIs('clients.tickets*')) text-primary-400 @endif"></i> {{ __('Tickets') }}
            </a>
            <br>
            <span class="text-sm text-secondary-600 mt-3">Account</span>
            <a href="{{ route('clients.profile') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-account-circle-line @if (request()->routeIs('clients.profile*')) text-primary-400 @endif"></i> {{ __('Profile') }}
            </a>
            <a href="{{ route('clients.credits') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-money-dollar-circle-line @if (request()->routeIs('clients.credits*')) text-primary-400 @endif"></i> {{ __('Credits') }}
            </a>
            @if (Auth::user()->has('ADMINISTRATOR'))
            <a href="{{ route('clients.api.index') }}" class="py-1 flex items-center gap-x-2 hover:text-secondary-800 duration-300">
                <i class="ri-code-s-slash-line @if (request()->routeIs('clients.api.index*')) text-primary-400 @endif"></i> {{ __('API') }}
            </a>
            @endif
            <div class="mt-auto pb-2">
                @if(config('settings::theme:website') == 1)
                <br>
                <div class="flex items-center gap-x-2 py-1">
                    <a href="{{ config('settings::theme:website-url', '#') }}" class="flex items-center gap-x-2 overflow-hidden">
                        <i class="ri-global-line"></i> <p class="leading-4">Website</p>
                    </a>
                </div>
                @endif
                @if(config('settings::theme:panel') == 1)
                <div class="flex items-center gap-x-2 py-1">
                    <a href="{{ config('settings::theme:panel-url', '#') }}" class="flex items-center gap-x-2 overflow-hidden">
                        <i class="ri-window-line"></i> <p class="leading-4">Panel</p>
                    </a>
                </div>
                @endif
                <br>
                <hr>
                <br>
                <div class="d-flex">
                    <a style="font-size: 24px;" type="button" href="{{ route('logout') }}"
                        class="px-2 py-1 hover:bg-secondary-300 gap-x-2 rounded float-right"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ri-logout-box-r-line"></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @if (Auth::user()->has('ADMINISTRATOR'))
                    <a style="font-size: 24px;float: right;margin: 0px 62px 0px 0px;" href="{{ route('admin.index') }}" class="px-2 py-1 hover:bg-secondary-300 gap-x-2 rounded">
                        <i class="ri-settings-4-fill"></i>
                    </a>
                    @endif
                    <button style="font-size: 24px;" class="py-1 float-left button button-secondary-outline !font-normal" id="theme-toggle">
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
                </div>
            </div>
        </div>
        <div class="fixed md:hidden top-0 w-screen h-full bg-black/50 backdrop-blur z-[-1]" onclick="openMobileMenu()">
        </div>
    </div>
@endif