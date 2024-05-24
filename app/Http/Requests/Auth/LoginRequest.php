<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // dd($this->type);
        if($this->type === 'email'){
            return [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ];
        }

        // using code
        return [
            'code'=>['required', 'string'],
        ];
        
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // dd($this->type);
        $this->ensureIsNotRateLimited();

        switch ($this->type) {
            case 'email':
                if (! Auth::attempt($this->only('email', 'password'))) {
                    RateLimiter::hit($this->throttleKey());
        
                    throw ValidationException::withMessages([
                        'email' => trans('auth.failed'),
                    ]);
                }
                break;

            case 'judge':
                $user = \App\Models\User::where('code', $this->input('code'))->first();
                if (!$user) {
                    RateLimiter::hit($this->throttleKey());
    
                    throw ValidationException::withMessages([
                        'code' => trans('auth.failed'),
                    ]);
                }

                // Check if the user is an admin
                if ($user->isAdmin) {
                    Auth::login($user);
                    break;
                }

                // Assuming the User model has a relationship method `judge` and Judge model has a relationship method `event`
                $judge = $user->judge;
                // dd($judge);
                if (!$judge) {
                    throw ValidationException::withMessages([
                        'code' => 'This user is not associated with any judge.',
                    ]);
                }

                $event = $judge->event;

                if (!$event || $event->status != 1) {
                    throw ValidationException::withMessages([
                        'code' => 'You are not able to authenticate on this event.',
                    ]);
                }
                // $user->load('judge'); // Eager load the judge relationship
                Auth::login($user);
                break;
            
            default:
                # code...
                  
                break;
        }
        

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return strtolower($this->input('email', $this->input('code'))).'|'.$this->ip();
    }
}
