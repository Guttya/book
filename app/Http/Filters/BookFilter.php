<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class BookFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const AUTHORS = 'authors';
    public const GENRES = 'genres';


    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::DESCRIPTION => [$this, 'description'],
            self::AUTHORS => [$this, 'authors'],
            self::GENRES => [$this, 'genres'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function authors(Builder $builder, $value)
    {
        $builder->whereHas('authors', function (Builder $query) use($value) {
            $query->whereIn('id', $value);
        });
    }

    public function genres(Builder $builder, $value)
    {
        $builder->where('genres', $value);
    }


}
