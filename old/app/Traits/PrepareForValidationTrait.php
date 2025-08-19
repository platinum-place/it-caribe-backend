<?php

namespace App\Traits;

trait PrepareForValidationTrait
{
    public function setIgnorecase(): void
    {
        $input = $this->all();
        $rules = $this->rules();
        $correctedInput = [];

        foreach ($rules as $ruleKey => $rule) {
            if (isset($input[$ruleKey])) {
                $correctedInput[$ruleKey] = $input[$ruleKey];
            }
        }

        foreach ($input as $inputKey => $value) {
            if (! isset($correctedInput[$inputKey])) {
                foreach ($rules as $ruleKey => $rule) {
                    if (strcasecmp($ruleKey, $inputKey) === 0) {
                        $correctedInput[$ruleKey] = $value;
                        break;
                    }
                }
            }
        }

        $this->replace($correctedInput);
    }
}
