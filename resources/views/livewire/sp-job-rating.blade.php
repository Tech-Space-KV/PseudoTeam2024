<!-- <div>
    {{-- Stop trying to control. --}}

</div> -->

<div>
    <span class="text-warning">
        @for ($i = 1; $i <= 5; $i++)
            @if ($averageRating >= $i)
                <i class="fa fa-star"></i>
            @elseif ($averageRating >= ($i - 0.5))
                <i class="fa fa-star-half-o"></i>
            @else
                <i class="fa fa-star-o"></i>
            @endif
        @endfor
    </span>
    <!-- <span class="text-muted">({{ $ratingsCount }} ratings)</span> -->
</div>

