<div class="prod-bottom-tab-sin">
    <h5>Review ({{$count}})</h5>
    <div class="product-review">
        <div class="reviwer">
            @foreach($comments as $c)
                <div class="review-details">
                    <span>Posted by {{$c->name}} - Published on	{{$c->created_at}}</span>
                    <p>{{$c->comment}}</p>
                </div>
            @endforeach
        </div>
        <div class="add-your-review">
            <h6>ADD A REVIEW</h6>
            <div class="raing-form">
                @error('cmt') <span class="text-danger">{{ $message }}</span> @enderror
                @error('noacc') <span class="text-danger">{{ $message }}</span> @enderror
                <textarea wire:model.debounce.500ms="cmt" name="rating-form" placeholder="Your comment"></textarea>
                <input wire:click="addCmt" type="submit">
            </div>
        </div>
    </div>
</div>
