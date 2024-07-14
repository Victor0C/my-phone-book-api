<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentContactsRepository implements ContactsRepositoryInterface
{
    private int $paginate;

    public function __construct()
    {
        $this->paginate = 10;
    }

    public function findAll($name = ''): LengthAwarePaginator
    {
        $query = Contact::query();

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function find(int $id): Contact
    {
        return Contact::findOrFail($id);
    }

    public function create(Contact $contact): Contact
    {
        $contact->save();
        return $contact;
    }

    public function update(int $id, Contact $contact): Contact
    {
        $existingContact = $this->find($id);
        
        $existingContact->fill($contact->toArray());

        $existingContact->save();
        
        return $existingContact;
    }

    public function delete(int $id): void
    {
        $contact = $this->find($id);
        $contact->delete();
    }
}