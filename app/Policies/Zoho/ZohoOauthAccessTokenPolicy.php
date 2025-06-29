<?php

namespace App\Policies\Zoho;

use App\Enums\Action;
use App\Enums\Model;
use App\Models\User;
use App\Models\Zoho\ZohoOauthAccessToken;

class ZohoOauthAccessTokenPolicy
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ZohoOauthAccessToken $zohoOauthAccessToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::VIEW));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::CREATE));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ZohoOauthAccessToken $zohoOauthAccessToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::UPDATE));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ZohoOauthAccessToken $zohoOauthAccessToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::DELETE));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ZohoOauthAccessToken $zohoOauthAccessToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::RESTORE));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ZohoOauthAccessToken $zohoOauthAccessToken): bool
    {
        return $user->hasPermissionTo(combine_permissions(Model::ZOHO_OAUTH_ACCESS_TOKEN, Action::FORCE_DELETE));
    }
}
