<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Announcement $announcement): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Announcement $announcement): bool
    {
       return $announcement->creator()->is($user);
    }

    public function delete(User $user, Announcement $announcement): bool
    {
        return $announcement->creator()->is($user);
    }

    public function restore(User $user, Announcement $announcement): bool
    {
        return $announcement->creator()->is($user);
    }

    public function forceDelete(User $user, Announcement $announcement): bool
    {
        return $announcement->creator()->is($user);
    }
}
