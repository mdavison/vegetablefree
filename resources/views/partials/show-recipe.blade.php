<h1 class="page-header">{{ $recipe->title }}</h1>
<p class="text-muted">{{ $recipe->created_at->toFormattedDateString() }}</p>

@if(count($recipe->photos))
    <div class="container-fluid">
        @foreach($recipe->photos as $photo)
            <div class="thumbnail">
                <img src="/photos/{{ $recipe->id }}/{{ $photo->filename }}"
                     alt="{{ $photo->filename }}"
                     class="img-responsive">
            </div>
        @endforeach
    </div>
@endif

<div class="clearfix">
    @if(!empty($recipe->description))
        <div class="container-fluid"><p>{{ $recipe->description }}</p><br></div>
    @endif
</div>

@if(count($recipe->ingredients))
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Ingredients</h3></div>
        <ul class="list-group">
            @foreach($recipe->ingredients as $ingredient)
                <li class="list-group-item">{{ $ingredient->name }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Directions</h3>
    </div>
    <div class="panel-body">
        <div class="markdown" id="show-directions">{{ $recipe->directions }}</div>
    </div>
</div>