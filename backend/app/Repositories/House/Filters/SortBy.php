<?php


namespace App\Repositories\House\Filters;


use App\Repositories\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class SortBy implements FilterContract
{
    protected string $field;
    protected string $order;

    /**
     * SortBy constructor.
     * @param string $field
     * @param string $order
     */
    public function __construct (string $field, string $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    /**
     * @inheritDoc
     */
    public function apply (Builder $query): void
    {
        $query->orderBy($this->field, $this->order === 'ascending' ? 'asc' : 'desc');
    }
}
