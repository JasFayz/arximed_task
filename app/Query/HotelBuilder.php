<?php

namespace App\Query;

use Illuminate\Database\Eloquent\Builder;

class HotelBuilder extends Builder
{

    public function whereName(?string $name)
    {
        return $this->when($name, function (Builder $query) use ($name) {
            $query->whereRaw('LOWER(name) like ? ', ['%' . strtolower($name) . '%']);
        });
    }

    public function whereBedroom(?int $bedrooms)
    {
        return $this->when($bedrooms, function (Builder $query) use ($bedrooms) {
            $query->where('bedrooms', $bedrooms);
        });
    }

    public function whereBathroom(?int $bathrooms)
    {
        return $this->when($bathrooms, function (Builder $query) use ($bathrooms) {
            $query->where('bathrooms', $bathrooms);
        });
    }

    public function whereStorey(?int $storeys)
    {
        return $this->when($storeys, function (Builder $query) use ($storeys) {
            $query->where('storeys', $storeys);
        });
    }

    public function whereGarage(?int $garages)
    {
        return $this->when($garages, function (Builder $query) use ($garages) {
            $query->where('garages', $garages);
        });
    }

    public function wherePrice(?array $price_range)
    {
        return $this->when($price_range, function (Builder $query) use ($price_range) {
            $query->whereBetween('price', $price_range);
        });
    }

}
