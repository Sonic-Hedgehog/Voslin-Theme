<x-app-layout description="{{ $category->description ?? null }}" title="{{ $category->name ?? __('Products') }}">
    <x-success />
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
    
    <style>
        .category {
            background: var(--secondary-100);
            padding: 10px;
        }
        .side {
            margin: 0px 20px 0px 0px;
        }
    </style>

    <div class="content">
        <h2 style="font-size: 20px;" class="font-semibold text-lg">{{ config('app.name', 'Voslin') }}</h2>
        <br>
        <div class="grid grid-cols-12 gap-1">
            @if ($categories->count() > 0)
                <div class="lg:col-span-3 col-span-12 side">
                    <div class="flex flex-col gap-2 mt-2">
                        @foreach ($categories as $categoryItem)
                            @if ($categoryItem->products->count() > 0)
                                <a href="{{ route('products', $categoryItem->slug) }}" class="@if ($category->name == $categoryItem->name) text-secondary-900 !border-primary-400 @endif border-l-2 border-transparent duration-300 hover:text-secondary-900 hover:border-primary-400 focus:text-secondary-900 focus:border-primary-400">      
                                    <div class="category">
                                        {{ $categoryItem->name }}
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="@if ($categories->count() > 0) lg:col-span-9 @endif col-span-12">
                <div class="content-box">
                    <h1 class="text-3xl font-semibold text-secondary-900">{{ $category->name }}</h1>
                    <p>{{ $category->description }}</p>
                </div>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    @foreach ($category->products()->with('prices')->orderBy('order')->get() as $product)
                        <div class="md:col-span-1 col-span-3">
                            <div class="content-box h-full flex flex-col">
                                    @if ($product->image !== 'null')
                                    <div style="display: flex;align-items: center;flex-direction: column;">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-14 rounded-md" onerror="removeElement(this);">
                                    </div>
                                    <br>
                                    @endif
                                    <div>
                                        <h3 style="text-align: center;" class="text-lg text-secondary-800 leading-5 font-semibold">
                                            {{ $product->name }}</h3>
                                        <h2 style="font-size: 35px; font-weight: 900; text-align:center;">{{ $product->price() ? config('settings::currency_sign') . $product->price() : __('Free') }}
                                        </h2>
                                    </div>
                                    <br>
                                <div style="display: flex;align-items: center;flex-direction: column;">
                                    <p>@markdownify($product->description)</p>
                                </div>
                                <br>
                                <div class="pt-3 mt-auto">
                                    @if ($product->stock_enabled && $product->stock <= 0)
                                        <a class="button bg-secondary-200 text-white w-full hover:cursor-not-allowed">
                                            Out of stock
                                        </a>
                                    @else
                                        <a href="{{ route('checkout.add', $product->id) }}" class="button button-secondary w-full">
                                            Add to cart <i class="ri-shopping-cart-line"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
