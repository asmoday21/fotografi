<?php
// app/Policies/KuisPolicy.php
namespace App\Policies;

use App\Models\Kuis;
use App\Models\User;

class KuisPolicy
{
    public function update(User $user, Kuis $kuis)
    {
        return $user->id === $kuis->user_id;
    }
    public function delete(User $user, Kuis $kuis)
    {
       return true;
    }
}
