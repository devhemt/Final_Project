<div class="sort-by-price">
    <select wire:model="status" class="orderby" name="orderby">
        @foreach ($options as $op)
            @if ($op=='all')
                <option selected="selected" value="{{ $op }}">{{ $op }}</option>
            @else
                <option value="{{ $op }}">{{ $op }}</option>
            @endif
        @endforeach
    </select>
</div>
