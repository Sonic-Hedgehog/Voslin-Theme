<x-app-layout title="{{ $announcement->title }}" description='{{ strip_tags(Str::markdown(nl2br(Stevebauman\Purify\Facades\Purify::clean($announcement->announcement)))) }}'>
    
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
        body {
            background-image: url("{{ config('settings::theme:bg-url', '#') }}");
            background-size: center;
            background-repeat: no-repeat;
        }
    </style>
     
    <!-- View Announcement -->
    <div class="content">
        <div class="content-box max-w-6xl mx-auto">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">{{ $announcement->title }}</h1>
                <div class="flex items-center gap-x-5">
                    <p class="text-secondary-600 flex items-center gap-x-2">
                        <i class="ri-calendar-line"></i>
                        {{ $announcement->created_at->format('d/m/Y') }}
                    </p>
                    <p class="text-secondary-600 flex items-center gap-x-2">
                        <i class="ri-time-line ml-1"></i>
                        {{ $announcement->created_at->format('H:i') }}
                    </p>
                </div>
            </div>
            <div class="prose dark:prose-invert max-w-full">
                @markdownify($announcement->announcement)
            </div>
        </div>
    </div>

</x-app-layout>
