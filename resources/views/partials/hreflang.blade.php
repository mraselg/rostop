{{-- SEO hreflang alternates (default locale = unprefixed EN canonical; bn/hi prefixed) --}}
@php
    $__segs = request()->segments();
    if (count($__segs) && in_array($__segs[0], ['en', 'bn', 'hi'], true)) {
        array_shift($__segs);
    }
    $__base = implode('/', $__segs);
@endphp
<link rel="alternate" hreflang="en" href="{{ url($__base) }}" />
<link rel="alternate" hreflang="bn-BD" href="{{ url('bn' . ($__base ? '/' . $__base : '')) }}" />
<link rel="alternate" hreflang="hi-IN" href="{{ url('hi' . ($__base ? '/' . $__base : '')) }}" />
<link rel="alternate" hreflang="x-default" href="{{ url($__base) }}" />