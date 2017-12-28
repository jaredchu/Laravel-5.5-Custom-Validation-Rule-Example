<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistsID implements Rule
{
    protected $notExistIDs;
    protected $table;
    protected $column;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $IDs = DB::table($this->table)->whereIn($this->column, $value)->pluck($this->column)->toArray();
        $this->notExistIDs = array_diff($value, $IDs);

        return count($this->notExistIDs) == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return strtr("Given :table :ids does not exist", [
            ':table' => $this->table,
            ':ids' => json_encode($this->notExistIDs)
        ]);
    }
}
