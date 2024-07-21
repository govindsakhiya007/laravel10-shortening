<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

/**
 * Custom User Provider for authentication.
 *
 * This class handles the authentication of users by providing custom logic
 * for retrieving users by their ID, token, and credentials. It also supports
 * password validation and the decryption of sensitive user information.
 */
class CustomUserProvider implements UserProvider
{
    /**
     * The User model instance.
     *
     * @var \App\Models\User
     */
    protected $model;

    /**
     * Create a new custom user provider instance.
     *
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return $this->model->newQuery()->find($identifier);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return $this->model->newQuery()->where($this->model->getRememberTokenName(), $token)->find($identifier);
    }

    /**
     * Update the "remember me" token for a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        $user->setRememberToken($token);
        $user->save();
    }

    /**
     * Retrieve a user by their credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (isset($credentials['email'])) {
            $emailHash = hash('sha256', $credentials['email']);

            return $this->model->newQuery()->where('email_hash', $emailHash)->first();
        }
        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    /**
     * Decrypt sensitive user information.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function decryptUser($user)
    {
        if ($user) {
            $user->email = Crypt::decryptString($user->email);
            $user->name = Crypt::decryptString($user->name);
        }
        return $user;
    }

    /**
     * Rehash password if required.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @param bool $force
     * @return bool
     */
    public function rehashPasswordIfRequired(UserContract $user, array $credentials, bool $force = false): bool
    {
        return false;
    }
}