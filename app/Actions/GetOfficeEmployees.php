<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class GetOfficeEmployees
{
    public function execute(): array
    {
        $employees = $this->getEmployees();
        $offices = $this->getOffices();

        return $this->mapEmployeesToOffices($employees, $offices);
    }

    private function getEmployees(): Collection
    {
        return collect([
            ['name' => 'John', 'city' => 'Dallas'],
            ['name' => 'Jane', 'city' => 'Austin'],
            ['name' => 'Jake', 'city' => 'Dallas'],
            ['name' => 'Jill', 'city' => 'Dallas'],
        ]);
    }

    private function getOffices(): Collection
    {
        return collect([
            ['office' => 'Dallas HQ', 'city' => 'Dallas'],
            ['office' => 'Dallas South', 'city' => 'Dallas'],
            ['office' => 'Austin Branch', 'city' => 'Austin'],
        ]);
    }

    private function mapEmployeesToOffices(Collection $employees, Collection $offices): array
    {
        return $offices
            ->groupBy('city')
            ->mapWithKeys(function ($officesInCity, $city) use ($employees) {
                $names = $employees
                    ->where('city', $city)
                    ->pluck('name')
                    ->values();

                $officesMap = $officesInCity->mapWithKeys(function ($office) use ($names) {
                    return [$office['office'] => $names->all()];
                });

                return [$city => $officesMap->all()];
            })
            ->toArray();
    }
}
