<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Models\Contact;
use App\Services\Interfaces\ContactsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ContactsController extends Controller
{
    public function __construct(private ContactsServiceInterface $contactService)
    {
        
    }

    public function index(ContactsRequest $request): JsonResponse
    {
        $contacts = $this->contactService->findAll($request->query('name', ''));
        return response()->json($contacts);
    }

    public function store(ContactsRequest $request): JsonResponse
    {
        $contactDTO = new Contact();
        $contactDTO->fill($request->all());

        $createdContact = $this->contactService->create($contactDTO);

        return response()->json($createdContact, 201);
    }

    public function show(string $id): JsonResponse
    {
        $contact = $this->contactService->find((int)$id);
        return response()->json($contact);
    }

    public function update(ContactsRequest $request, string $id): JsonResponse
    {
        $contactDTO = new Contact();
        $contactDTO->fill($request->all());

        $updatedContact = $this->contactService->update((int)$id, $contactDTO);

        return response()->json($updatedContact);
    }

    public function destroy(string $id)
    {
        $this->contactService->delete((int)$id);
        return response()->json(null, 204);
    }

}


