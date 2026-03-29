@props(['url'])
@php
    $logoUrl = rtrim(config('app.url'), '/').'/admin/images/logo.svg';
@endphp
<tr>
<td class="header" style="padding: 28px 16px 20px; text-align: center;">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
<img src="{{ $logoUrl }}" alt="{{ config('app.name') }}" class="logo" width="64" height="64" style="display: block; margin: 0 auto 14px; border: 0;">
<span style="display: block; color: #1D3573; font-size: 20px; font-weight: 700; letter-spacing: -0.02em; line-height: 1.2;">{{ $slot }}</span>
</a>
</td>
</tr>
