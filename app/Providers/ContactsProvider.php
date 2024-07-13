<?php

namespace App\Providers;

use App\Repositories\EloquentContactsRepository;
use App\Repositories\Interfaces\ContactsRepositoryInterface;
use App\Services\ContactsService;
use App\Services\Interfaces\ContactsServiceInterface;
use Illuminate\Support\ServiceProvider;

class ContactsProvider extends ServiceProvider
{
    public array $bindings = [
        ContactsRepositoryInterface::class => EloquentContactsRepository::class,
        ContactsServiceInterface::class => ContactsService::class,
    ];
}
