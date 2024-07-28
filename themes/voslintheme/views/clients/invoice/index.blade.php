<x-app-layout title="Invoices" clients>
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
    <div class="content">
        <div class="content-box content-box !p-0 overflow-hidden">
            <h2 class="text-xl font-semibold p-6">{{ __('Invoices') }}</h2>
            @if ($invoices->count() > 0)
                <table class="w-full">
                    <thead class="border-b-2 border-secondary-200 dark:border-secondary-50 text-secondary-600">
                    <tr>
                        <th scope="col" class="text-start pl-6 py-2 text-sm font-normal">
                            {{ __('ID')}}
                        </th>
                        <th scope="col" class="text-start pl-6 py-2 text-sm font-normal">
                            {{ __('Total') }}
                        </th>
                        <th scope="col" class="text-start pr-6 py-2 text-sm font-normal">
                            {{ __('Created Date') }}
                        </th>
                        <th scope="col" class="text-start pr-6 py-2 text-sm font-normal">
                            {{ __('Status') }}
                        </th>
                        <th scope="col" class="text-start pr-6 py-2 text-sm font-normal">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoices->sortByDesc('status') as $invoice)
                        @if ($invoice->items->count() == 0)
                            @continue
                        @endif
                        <tr class="border-b-2 border-secondary-200 dark:border-secondary-50">
                            <td class="pl-6 py-3">
                                {{ $invoice->id }}
                            </td>
                            <td class="pl-6 py-3">
                                {{ $invoice->total() }} {{ config('settings::currency_sign') }}
                            </td>
                            <td class="pr-6 py-3">
                                {{ $invoice->created_at }}
                            </td>
                            <td class="pr-6 py-3">
                                @if (ucfirst($invoice->status) == 'Pending')
                                    <span class="text-red-400 font-semibold">
                                        {{ __('Pending') }}
                                    </span>
                                @elseif (ucfirst($invoice->status) == 'Paid')
                                    <span class="text-green-400 font-semibold">
                                        {{__('Paid')}}
                                    </span>
                                @elseif (ucfirst($invoice->status) == 'Cancelled')
                                    <span class="text-orange-400 font-semibold">
                                        {{__('Cancelled')}}
                                    </span>
                                @else
                                    <span class="text-gray-400 font-semibold">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="pr-6 py-3">
                                <a href="{{ route('clients.invoice.show', $invoice->id) }}"
                                   class="button button-secondary">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
