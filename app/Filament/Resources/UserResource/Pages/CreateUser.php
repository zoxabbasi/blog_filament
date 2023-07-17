<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Model\User;
use Filament\Pages\Actions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $user = static::getModel()::create($data);
        $user->assignRole('admin');
        //
        return $user;
    }
    // To assign admin role to any user created by admin automatically
}
