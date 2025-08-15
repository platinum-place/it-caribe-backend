<?php

namespace App\Livewire;

use App\Enums\forlder\Action;
use App\Enums\forlder\Model;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;

class EditPermissionsForm extends Component implements HasForms
{
    use InteractsWithForms;

    public User $user;

    public ?array $data = [];

    public function mount(User $user): void
    {
        $this->user = $user;

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $fields = [];

        foreach (Model::cases() as $model) {
            $modelFields = [];

            foreach (Action::cases() as $action) {
                $modelFields[] = Forms\Components\Toggle::make($model->value.'.'.$action->value)
                    ->label($action->getLabel())
                    ->default($this->user->hasPermissionTo(combine_permissions($model, $action)));
            }

            $fields[] = Forms\Components\Fieldset::make($model->getLabel())
                ->schema($modelFields)
                ->columns(6);
        }

        return $form
            ->schema($fields)
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();

        foreach ($data as $model => $permissions) {
            foreach ($permissions as $permission => $value) {
                if ($value) {
                    $this->user->givePermissionTo(combine_permissions($model, $permission));
                } else {
                    $this->user->revokePermissionTo(combine_permissions($model, $permission));
                }
            }
        }

        Notification::make()
            ->title(__('Success'))
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.edit-permissions-form');
    }
}
