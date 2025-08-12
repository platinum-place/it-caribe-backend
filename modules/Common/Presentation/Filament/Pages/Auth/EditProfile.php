<?php

namespace Modules\Common\Presentation\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
//                TextInput::make('username')
//                    ->translateLabel()
//                    ->required()
//                    ->maxLength(255),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent()
                    ->required(false),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
