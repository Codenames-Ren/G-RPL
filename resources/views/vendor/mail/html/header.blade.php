@props(['url'])

<tr>
<td class="header">

<a href="{{ $url }}" style="display: inline-block; text-align: center;">

    {{-- Logo G-RPL --}}
    <img
        src="{{ asset('images/logo.png') }}"
        class="logo"
        alt="G-RPL Logo"
        style="
            height: 80px;
            width: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        "
    >

    {{-- System Name --}}
    <div style="
        color: #1565C0;
        font-size: 24px;
        font-weight: 700;
        margin-top: 8px;
        letter-spacing: 0.5px;
    ">
        G-RPL
    </div>

    {{-- Subtitle --}}
    <div style="
        color: #64748b;
        font-size: 13px;
        margin-top: 4px;
        font-weight: 500;
    ">
        Sistem Rekognisi Pembelajaran Lampau
    </div>

</a>

</td>
</tr>