<?php

namespace App\Orchid\Screens\Films;

use App\Models\Dictionaries\Country;
use App\Models\Films\Film;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class FilmListScreen extends Screen
{

    public string $name = 'FilmListScreen';

    public string $description = 'FilmListScreen';

    public function query(): array
    {
        return [
            'films' => Film::query()->latest()->get(),
        ];
    }

    public function commandBar(): array
    {
        return [
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('films', [
                TD::make('id'),
                TD::make('name'),
                TD::make('Actions')
                    ->render(fn (Country $country) => DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list(
                            [
                            ]
                        )
                    ),

            ]),
        ];
    }
}
