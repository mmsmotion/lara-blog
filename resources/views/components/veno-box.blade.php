<a class="venobox" @if($gall) data-gall="{{ $gall }}" @endif href="{{ isset($big) ? $big : $small }}">
    <img src="{{ $small }}" class="w-100" @isset($width) width="{{ $width }}" @endisset @isset($height) height="{{ $height }}" @endisset alt="image alt"/>
</a>
