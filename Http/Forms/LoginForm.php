<?php 

namespace Http\Forms;

use Core\ValidationException;
use Services\ValidatorService;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $messages = [
            'email.required' => 'Please provide a valid email.',
            'password.required' => 'Please provide a valid password.',
        ];

        $this->errors = ValidatorService::validate($attributes, $rules, $messages);
    }

    public static function validate($attributes)
    {
        
        $instance = new static($attributes);

        if ($instance->hasErrors()) {
            $instance->throw();
        }

        return $instance;
    }

    public function hasErrors()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function addError($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }
}