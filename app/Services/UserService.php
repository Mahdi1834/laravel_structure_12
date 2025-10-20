<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;




class UserService
{
    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
            return User::create($data);
        });
    }

    /**
     * Update an existing user.
     */
    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->fill($data);
            $user->save();

            return $user->refresh();
        });
    }

    /**
     * Find a user by id.
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Find a user by email.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Delete a user.
     */
    public function delete(User $user): bool
    {
        return DB::transaction(function () use ($user) {
            return (bool) $user->delete();
        });
    }

    /**
     * Paginate users.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return User::query()->orderByDesc('created_at')->paginate($perPage);
    }
}
