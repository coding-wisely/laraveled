<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileSizeWithName implements ValidationRule
{
    protected int $maxSize; // Maximum file size in bytes
    protected string $fileName; // The file name

    /**
     * Create a new rule instance.
     *
     * @param int $maxSize
     */
    public function __construct(int $maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extract the file name
        $this->fileName = $value->getClientOriginalName();

        // Check if the file size exceeds the maximum allowed size
        if ($value->getSize() > $this->maxSize) {
            $fail("{$this->fileName} must not be greater than " . ($this->maxSize / 1024) . " KB.");
        }
    }
}
