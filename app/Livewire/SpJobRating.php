<?php

namespace App\Livewire;

use App\Models\SpRatings;
use Livewire\Component;

class SpJobRating extends Component
{
    public function render()
    {

        // $ratings = SpRatings::where('sprtng_sp_id', session('sp_user_id'))->get();

        $ratings = SpRatings::where('sprtng_sp_id', session('sp_user_id'))->get();

        $ratingsCount = $ratings->count();
        $totalRating = $ratings->sum('sprtng_rate'); 
        $averageRating = $ratingsCount > 0 ? round($totalRating / $ratingsCount, 2) : 0;

        return view('livewire.sp-job-rating', compact('averageRating' , 'ratingsCount'));
    }
}
