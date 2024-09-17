<?php

namespace App\Orchid\Screens;

use App\Models\Dictionaries\Country;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CountryListScreen extends Screen
{

    public string $name = 'CountryListScreen';

    public string $description = 'CountryListScreen';

    public function query(): array
    {
        return [
            'countries' => Country::query()->latest()->get(),
        ];
    }

    public function commandBar(): array
    {
        return [
            ModalToggle::make('Add country')
                ->modal('countryModal')
                ->method('create')
                ->icon('plus'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('countries', [
                TD::make('id'),
                TD::make('name'),
                TD::make('Delete')
                    ->alignRight()
                    ->render(function (Country $country) {
                        return Button::make('Delete country')
                            ->confirm('Вы уверены?')
                            ->method('delete', ['country' => $country->id]);
                    }),
                TD::make('Update')
                    ->alignRight()
                    ->render(function (Country $country) {
                        return ModalToggle::make('Update')
                            ->modal('updateCountryModal')
                            ->method('update', ['country' => $country->id]);
                    }),

            ]),
            Layout::modal('countryModal', Layout::rows([
                Input::make('country.name')
                    ->title('Name')
                    ->placeholder('Введите название страны'),
            ]))
                ->title('Add country')
                ->applyButton('Add country'),
            Layout::modal('updateCountryModal', Layout::rows([
                Input::make('country.name')
                    ->title('Name')
                    ->placeholder('Введите название страны')
                    ->value('country.name')
            ]))
                ->title('Update country')
                ->applyButton('Update country')
                ->deferred('countryData')
        ];
    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function create(Request $request): void
    {
        $validated = $request->validate([
            'country.name' => ['required', 'max:255'],
        ]);

        Country::query()
            ->create(
                [
                    'name' => $validated['country']['name'],
                ]
            );
    }

    public function delete(Country $country): void
    {
        $country->delete();
    }

    /**
     * @param Country $country
     * @param Request $request
     *
     * @return void
     */
    public function update(Country $country, Request $request): void
    {
        $validated = $request->validate([
            'country.name' => ['required', 'max:255'],
        ]);

        $country
            ->update(
                [
                    'name' => $validated['country']['name'],
                ]
            );
    }

    /**
     * @param Country $country
     * @return array
     *
     * @psalm-api
     */
    public function countryData(Country $country): array
    {
        return [
            'country.name' => $country->name,
        ];
    }
}
