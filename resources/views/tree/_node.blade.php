<li>
    <div class="person">
        <div class="name">{{ $person->Name }}</div>
        <div class="gender">({{ $person->Gender }})</div>
    </div>

    @if ($person->children && $person->children->count() > 0)
        <ul>
            @foreach ($person->children as $child)
                @include('tree.node', ['person' => $child])
            @endforeach
        </ul>
    @endif
</li>
