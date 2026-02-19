<?php

namespace App\Domains\User\Controllers;

use App\Domains\User\Actions\UpdatePasswordAction;
use App\Domains\User\Actions\UpdateProfileDataAction;
use App\Domains\User\Requests\UpdatePasswordRequest;
use App\Domains\User\Requests\UpdateProfileDataRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UpdateProfileDataAction $updateProfileDataAction,
        private readonly UpdatePasswordAction $updatePasswordAction
    ) {}

    /**
     * Show the profile edit form.
     */
    public function edit(): View
    {
        return view('user.profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update profile data (name, email).
     */
    public function updateProfileData(UpdateProfileDataRequest $request): RedirectResponse
    {
        $this->updateProfileDataAction->execute($request->user(), $request->validated());

        return back()->with('status', 'profile-updated');
    }

    /**
     * Update password.
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $this->updatePasswordAction->execute($request->user(), $request->validated('password'));

        return back()->with('status', 'password-updated');
    }
}
