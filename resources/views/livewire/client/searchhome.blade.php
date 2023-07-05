<div>
    <a href="javascript:void(0)"><i class="fa fa-search" wire:click="resetinput" aria-hidden="true" wire:ignore></i>
    </a>
    <input wire:model="search_home" type="text" class="search-input" placeholder="Search" wire:ignore>
    <div class="search-output" style="{{$hide}}">
        @foreach($results as $r)
        <a href="{{url('/product/'.$r->id)}}">{{$r->name}}</a>
        @endforeach
    </div>
</div>
