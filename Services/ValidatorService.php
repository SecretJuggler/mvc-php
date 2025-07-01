<?php

namespace Services;

use Core\Validator;

class ValidatorService
{
    public static function validate(array $data, array $rules, array $messages = []): array
    {
        $errors = [];

        foreach ($rules as $field => $ruleSet) {
            $value = $data[$field] ?? null;
            $individualRules = explode('|', $ruleSet);

            foreach ($individualRules as $rule) {
                if (str_contains($rule, ':')) {
                    [$ruleName, $param] = explode(':', $rule);
                } else {
                    $ruleName = $rule;
                    $param = null;
                }

                $fieldLabel = self::formatFieldName($field);

                switch ($ruleName) {
                    case 'required':
                        if (is_null($value) || trim($value) === '') {
                            $key = "{$field}.$ruleName";
                            $message = $messages[$key] ?? self::defaultMessage($fieldLabel, $ruleName, $param);
                            $errors[$field] = $message;
                        }
                        break;

                    case 'string':
                        if (!Validator::string($value)) {
                            $key = "{$field}.$ruleName";
                            $message = $messages[$key] ?? self::defaultMessage($fieldLabel, $ruleName, $param);
                            $errors[$field] = $message;
                        }
                        break;

                    case 'email':
                        if (!Validator::email($value)) {
                            $key = "{$field}.$ruleName";
                            $message = $messages[$key] ?? self::defaultMessage($fieldLabel, $ruleName, $param);
                            $errors[$field] = $message;
                        }
                        break;

                    case 'min':
                        if (strlen($value) < (int) $param) {
                            $key = "{$field}.$ruleName";
                            $message = $messages[$key] ?? self::defaultMessage($fieldLabel, $ruleName, $param);
                            $errors[$field] = $message;
                        }
                        break;

                    case 'max':
                        if (strlen($value) > (int) $param) {
                            $key = "{$field}.$ruleName";
                            $message = $messages[$key] ?? self::defaultMessage($fieldLabel, $ruleName, $param);
                            $errors[$field] = $message;
                        }
                        break;
                    case 'same':
                        $otherValue = $data[$param] ?? null;

                        if ($value !==$otherValue) {
                            $key = "{$field}.$ruleName";
                            $otherLabel = self::formatFieldName($param);
                            $message  = $messages[$key] ?? "$fieldLabel must match $otherLabel.";
                            $errors[$field] = $message;
                        }
                        break;
                    default:
                        break;
                }

                if (isset($errors[$field])) {
                    break;
                }
            }
        }

        return $errors;
    }

    private static function formatFieldName(string $field): string
    {
        return ucwords(str_replace('_', ' ', $field));
    }

    private static function defaultMessage(string $fieldLabel, string $ruleName, $param = null): string
    {
        return match ($ruleName) {
            'required' => "$fieldLabel is required.",
            'string'   => "$fieldLabel must be a valid string and under 255 characters.",
            'email'    => "$fieldLabel must be a valid email address.",
            'min'      => "$fieldLabel must be at least $param characters.",
            'max'      => "$fieldLabel must not exceed $param characters.",
            'same'     => "$fieldLabel must match " . self::formatFieldName($param) . ".",
            default    => "$fieldLabel is invalid."
        };
    }
}
