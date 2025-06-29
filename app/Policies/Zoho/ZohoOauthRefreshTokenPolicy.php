<?php

namespace App\Policies\Zoho;

use App\Enums\Action;
use App\Enums\Model;
use App\Models\User;
use App\Models\Zoho\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::VIEW_ANY));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ZohoOauthRefreshToken $zohoOauthRefreshToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::VIEW));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ZohoOauthRefreshToken $zohoOauthRefreshToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ZohoOauthRefreshToken $zohoOauthRefreshToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::DELETE));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ZohoOauthRefreshToken $zohoOauthRefreshToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::RESTORE));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ZohoOauthRefreshToken $zohoOauthRefreshToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_REFRESH_TOKEN, Action::FORCE_DELETE));
    }
}
