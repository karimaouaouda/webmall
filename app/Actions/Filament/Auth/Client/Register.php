<?php

namespace App\Actions\Filament\Auth\Client;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Pages\Auth\Register as FilamentRegister;
use Filament\Support\Colors\Color;

class Register extends FilamentRegister
{


    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        Placeholder::make('separator')
                            ->label('or use social accounts :'),

                        Actions::make([
                            Action::make('fb')
                                ->color(Color::Blue)
                                ->label('continue with facebook')
                                ->action(function (){
                                    $this->redirect(route('social.redirect', ['service' => 'fb']), false);
                                })
                        ])->fullWidth(),
                        Actions::make([
                            Action::make('google')
                                ->color(Color::Sky)
                                ->label('continue with google')
                                ->action(function (){
                                    $this->redirect('https://www.webmall.test/auth/redirect/google', false);
                                })
                        ])->fullWidth(),
                        Actions::make([
                            Action::make('github')
                                ->color(Color::Slate)
                                ->label('continue with github')
                                ->action(function (){
                                    $this->redirect('https://www.webmall.test/auth/redirect/github', false);
                                } )
                        ])->fullWidth()
                    ])
                    ->statePath('data'),
            ),
        ];
    }

}

/**
 * TODO 1 - fix social registration
 * TODO 2 - add shippment fields and tags to product creation
 * TODO 3 - fix social registration
*/
