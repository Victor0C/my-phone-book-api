<?php
namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\Contact;
use App\Repositories\Interfaces\ContactsRepositoryInterface;
use App\Services\Interfaces\ContactsServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactsService implements ContactsServiceInterface{
    public function __construct(
        private ContactsRepositoryInterface $contactsRepository,
    ) {
    }

    public function findAll($name = ''): LengthAwarePaginator
    {
        return $this->contactsRepository->findAll($name);
    }

    public function find(int $id): Contact
    {
        //try and catch necessary to prevent Eloquent from sending its own exception to whoever is consuming the API
        try {
            return $this->contactsRepository->find($id);
        } catch (\Exception $e) {
            throw new NotFoundException("Contact not found with ID: $id");
        }
    }

    public function create(Contact $contactDTO): Contact
    {
        $task = new Contact();
        $task->fill($contactDTO->toArray());

        return $this->contactsRepository->create($task);
    }

    public function update(int $id, Contact $contactDTO): Contact
    {
        $task = $this->find($id);
        $task->fill($contactDTO->toArray());

        return $this->contactsRepository->update($id, $task);
    }

    public function delete(int $id): void
    {
        $this->find($id);
        $this->contactsRepository->delete($id);
    }
}