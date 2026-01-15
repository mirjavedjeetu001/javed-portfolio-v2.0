{{-- SEO Meta Tags Partial --}}
@php
    $seo = \App\Models\SeoSetting::getSettings();
    $pageTitle = $pageTitle ?? $seo->site_title ?? config('app.name');
    $pageDescription = $pageDescription ?? $seo->meta_description ?? '';
    $pageKeywords = $pageKeywords ?? $seo->meta_keywords ?? '';
    $pageImage = $pageImage ?? ($seo->og_image ? asset($seo->og_image) : '');
    $canonicalUrl = $canonicalUrl ?? $seo->canonical_url ?? url()->current();
@endphp

{{-- Basic Meta Tags --}}
<meta name="description" content="{{ $pageDescription }}">
<meta name="keywords" content="{{ $pageKeywords }}">
@if($seo->meta_author)
<meta name="author" content="{{ $seo->meta_author }}">
@endif
<meta name="robots" content="{{ $seo->robots_txt ?? 'index, follow' }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $seo->og_title ?? $pageTitle }}">
<meta property="og:description" content="{{ $seo->og_description ?? $pageDescription }}">
<meta property="og:type" content="{{ $seo->og_type ?? 'website' }}">
<meta property="og:url" content="{{ url()->current() }}">
@if($pageImage)
<meta property="og:image" content="{{ $pageImage }}">
@endif
@if($seo->og_site_name)
<meta property="og:site_name" content="{{ $seo->og_site_name }}">
@endif
<meta property="og:locale" content="en_US">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
@if($seo->twitter_site)
<meta name="twitter:site" content="{{ $seo->twitter_site }}">
@endif
@if($seo->twitter_creator)
<meta name="twitter:creator" content="{{ $seo->twitter_creator }}">
@endif
<meta name="twitter:title" content="{{ $seo->og_title ?? $pageTitle }}">
<meta name="twitter:description" content="{{ $seo->og_description ?? $pageDescription }}">
@if($pageImage)
<meta name="twitter:image" content="{{ $pageImage }}">
@endif

{{-- Google Site Verification --}}
@if($seo->google_site_verification)
<meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
@endif

{{-- Bing Site Verification --}}
@if($seo->bing_site_verification)
<meta name="msvalidate.01" content="{{ $seo->bing_site_verification }}">
@endif

{{-- Schema.org Structured Data --}}
@if($seo->schema_enabled)
@if($seo->schema_custom_json)
<script type="application/ld+json">
{!! $seo->schema_custom_json !!}
</script>
@else
@php
    $schemaData = [
        '@context' => 'https://schema.org',
        '@type' => $seo->schema_type ?? 'Person',
        'name' => $about->name ?? config('app.name'),
        'url' => url('/'),
    ];
    
    if (isset($about) && $about->image) {
        $schemaData['image'] = asset('storage/' . $about->image);
    }
    if (isset($about) && $about->bio) {
        $schemaData['description'] = Str::limit(strip_tags($about->bio), 200);
    }
    if (isset($about) && $about->email) {
        $schemaData['email'] = $about->email;
    }
    if (isset($about) && $about->title) {
        $schemaData['jobTitle'] = $about->title;
    }
    
    $sameAs = [];
    if (isset($about) && $about->facebook) $sameAs[] = $about->facebook;
    if (isset($about) && $about->twitter) $sameAs[] = $about->twitter;
    if (isset($about) && $about->linkedin) $sameAs[] = $about->linkedin;
    if (isset($about) && $about->github) $sameAs[] = $about->github;
    if (!empty($sameAs)) {
        $schemaData['sameAs'] = $sameAs;
    }
@endphp
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endif

{{-- Google AdSense --}}
@if($seo->adsense_enabled && $seo->adsense_publisher_id)
<meta name="google-adsense-account" content="{{ $seo->adsense_publisher_id }}">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $seo->adsense_publisher_id }}" crossorigin="anonymous"></script>
@endif
