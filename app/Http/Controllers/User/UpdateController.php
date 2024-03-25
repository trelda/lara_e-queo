<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $reqest, User $user) {
        $data = $reqest->validated();
        $this->service->update($user, $data);
        return redirect()->route('home');
    }
}