<x-mail::layout>

{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
G-RPL
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>

<x-mail::subcopy>

<div style="
    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
">

{!! $subcopy !!}

</div>

</x-mail::subcopy>

</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>

<x-mail::footer>

<div style="
    text-align: center;
    color: #94a3b8;
    font-size: 12px;
    line-height: 1.7;
">

© {{ date('Y') }} G-RPL System <br>

Sistem Rekognisi Pembelajaran Lampau <br>

Global Institute

</div>

</x-mail::footer>

</x-slot:footer>

</x-mail::layout>