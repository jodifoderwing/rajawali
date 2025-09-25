<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Filament\Http\Responses\Auth\LogoutResponse as BaseLogoutResponse;

class LogoutResponse extends BaseLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        $panel = Filament::getCurrentPanel()->getId();
        // dd($panel);
        // if (Filament::getCurrentPanel()->getId() === 'kalurahan') {
        //     // return redirect()->to(Filament::getLoginUrl());
        //     return redirect()->to(Filament::getLoginUrl(['user']));
        //     // return redirect()->to('user');
        // }

        return redirect()->to(Filament::getLoginUrl(['user']));
        // return parent::toResponse($request);
    }
}
