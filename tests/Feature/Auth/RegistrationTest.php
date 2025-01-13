<?php

namespace Tests\Feature\Auth;

use Livewire\Volt\Volt;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response
        ->assertOk()
        ->assertSeeVolt('pages.auth.register');
});


use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

it('validates a password that meets the requirements', function () {
    $rules = [
        'password' => [
            'required',
            'string',
            'confirmed',
            \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ];

    // Test a valid password
    $data = [
        'password' => 'ValidP@ssw0rd',
        'password_confirmation' => 'ValidP@ssw0rd',
    ];

    $validator = Validator::make($data, $rules);

    expect($validator->fails())->toBeFalse(); // Ensure validation passes
});

it('fails validation if password is less than 8 characters', function () {
    $rules = [
        'password' => [
            'required',
            'string',
            'confirmed',
            \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ];

    // Test an invalid password
    $data = [
        'password' => 'Short1!',
        'password_confirmation' => 'Short1!',
    ];

    $validator = Validator::make($data, $rules);

    expect(fn() => $validator->validate())->toThrow(ValidationException::class);
});

it('fails validation if password does not include a number', function () {
    $rules = [
        'password' => [
            'required',
            'string',
            'confirmed',
            \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ];

    $data = [
        'password' => 'NoNumbers!',
        'password_confirmation' => 'NoNumbers!',
    ];

    $validator = Validator::make($data, $rules);

    expect(fn() => $validator->validate())->toThrow(ValidationException::class);
});

it('fails validation if password does not include an uppercase letter', function () {
    $rules = [
        'password' => [
            'required',
            'string',
            'confirmed',
            \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ];

    $data = [
        'password' => 'lowercase1!',
        'password_confirmation' => 'lowercase1!',
    ];

    $validator = Validator::make($data, $rules);

    expect(fn() => $validator->validate())->toThrow(ValidationException::class);
});

it('fails validation if password does not include a special character', function () {
    $rules = [
        'password' => [
            'required',
            'string',
            'confirmed',
            \Illuminate\Validation\Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
        ],
    ];

    $data = [
        'password' => 'NoSpecial123',
        'password_confirmation' => 'NoSpecial123',
    ];

    $validator = Validator::make($data, $rules);

    expect(fn() => $validator->validate())->toThrow(ValidationException::class);
});
test('new users can register', function () {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'passworD123#')
        ->set('password_confirmation', 'passworD123#');

    $component->call('register');

    $component->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
