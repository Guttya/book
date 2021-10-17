<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class BookFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const AUTHORS = 'authors';


    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::AUTHORS => [$this, 'authors'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "{$value}%");
    }

    public function authors(Builder $builder, $value)
    {
        $builder->whereHas('authors', function (Builder $query) use($value) {
            $query->whereIn('id', $value);
        });
    }
}
