<div class="container">
    @if(count($recipes))
        <?php $counter = 1; ?>
        @foreach($recipes as $recipe)

            @if($counter === 1)
                <div class="row">
            @endif

                    <div class="col-md-4">
                        <div class="recipe-container">
                            @if(count($recipe->photos))
                                @foreach($recipe->photos as $key => $photo)
                                    @if($key === 0)
                                        <a href="/recipes/{{ $recipe->slug }}">
                                            <img src="/photos/{{ $photo->filename }}" alt="{{ $photo->filename }}">
                                        </a>
                                    @endif
                                @endforeach
                            @endif

                            <h3><a href="/recipes/{{ $recipe->slug }}">{{ $recipe->title }}</a></h3>

                            {{ $recipe->description }}

                            <div class="border"></div>
                        </div>
                    </div>

            @if($counter === 3)
                </div><!-- .row -->
            @endif

            <?php
            $counter++;
            if ($counter > 3) $counter = 1;
            ?>

        @endforeach
    @endif
</div> <!-- /container -->