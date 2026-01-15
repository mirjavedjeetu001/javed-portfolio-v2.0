{{-- Google Analytics & AdSense Scripts Partial --}}
@php
    $seo = \App\Models\SeoSetting::getSettings();
@endphp

{{-- Google Analytics --}}
@if($seo->ga_enabled && $seo->ga_measurement_id)
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->ga_measurement_id }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $seo->ga_measurement_id }}', {
        'page_title': document.title,
        'page_location': window.location.href,
        'page_path': window.location.pathname
    });
</script>
@endif

{{-- Google AdSense --}}
@if($seo->adsense_enabled && $seo->adsense_publisher_id)
<!-- Google AdSense Auto Ads -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $seo->adsense_publisher_id }}" crossorigin="anonymous"></script>
@endif
