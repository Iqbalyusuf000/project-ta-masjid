@if ($member->photo_url)
    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
        class="{{ $size }} rounded-full object-cover border-4 border-primary/20 shadow-sm mx-auto">
@else
    <div class="{{ $size }}
                rounded-full
                bg-primary
                text-white
                flex
                items-center
                justify-center
                font-bold
            {{ $textSize }}
            border-4
            border-primary/20
                shadow-sm">
        {{ $member->initials }}
    </div>
@endif