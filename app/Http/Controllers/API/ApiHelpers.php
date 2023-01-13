<?php

namespace App\Http\Controllers\API;
trait ApiHelpers
{
    protected function isAdmin($user): bool
    {
        if (!empty($user) && $user->isAdmin == 1) {
            return true;
        }
        return false;
    }
}
