<?php

namespace App\Presentation\Request\LinkRequest\Rules;

use App\Domain\Entities\Enum\ShortCodeLength;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CodeLengthRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $length = strlen($value);

        foreach (ShortCodeLength::cases() as $case) {
            if ($length === $case->value) {
                return;
            }
        }

        $allowed = implode(', ', array_map(
            fn ($case) => $case->value,
            ShortCodeLength::cases()
        ));

        $fail("Длина поля {$attribute} должна быть одной из: {$allowed} символов.");
    }
}
