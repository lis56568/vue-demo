<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Repositories\NoteRepository;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
class NoteController extends Controller
{
    private NoteRepository $noteRepository;
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function index(): \Inertia\Response
    {
        $data = $this->noteRepository->getNote()->toArray();
        return Inertia::render('Note', ["notes" => $data]);
    }

    public function create(CreateNoteRequest $request): \Illuminate\Http\JsonResponse
    {
        $note = $this->noteRepository->createNote(
            $request->input('text')
        );
        return response()->json([
            'message' => 'Note created successfully.',
            'note' => $note,
        ], 201);
    }

    public function update(UpdateNoteRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $note = $this->noteRepository->updateNote(
            $id,
            $request->input('text')
        );
        return response()->json([
            'message' => 'Note updated successfully.',
            'note' => $note,
        ]);
    }

    public function delete($id): void
    {
        $this->noteRepository->deleteNote($id);
    }
}
