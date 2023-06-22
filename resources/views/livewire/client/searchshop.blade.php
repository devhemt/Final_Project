<div>
    <div class="sidebar-widget sidebar-search">
        <input type="text" placeholder="Search Product...." wire:model="autoSearch" value="{{ $searching }}">
        <button type="submit" wire:click="search()"><i class="fas fa-search"></i></button>
    </div>
    <div class="sidebar-widget category-widget">
        <h6>PRODUCT CATEGORIES</h6>
        <ul>
            <li><a style="font-weight: {{$style1}}" wire:click="find(1)">Man Clothing </a> <span>({{$men}})</span></li>
            <li><a style="font-weight: {{$style2}}" wire:click="find(2)">Woman Clothing </a> <span>({{$women}})</span></li>
            <li><a style="font-weight: {{$style3}}" wire:click="find(3)">kid Clothing </a> <span>({{$kid}})</span></li>
            <li><a style="font-weight: {{$style4}}" wire:click="find(4)">Accessories </a> <span>({{$ass}})</span></li>
        </ul>
    </div>
</div>
