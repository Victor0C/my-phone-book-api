<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContactsRepositoryInterface
{
    public function findAll($name = ''): LengthAwarePaginator;
    public function find(int $id): Contact;
    public function create(Contact $contact): Contact;
    public function update(int $id, Contact $contact): Contact;
    public function delete(int $id): void;
}
