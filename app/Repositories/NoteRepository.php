<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\Note;
use function Laravel\Prompts\text;

class NoteRepository{
    private Note $model;
    public function __construct(Note $model)
    {
        $this->model = $model;
    }

    public function getNote(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function createNote(string $text, bool $isEdit=false): Note
    {
        return $this->model->create([
            'text' => $text,
            'isEdit' => $isEdit,
        ]);
    }

    public function updateNote($id, string $text, bool $isEdit=false): Note
    {
        $note = $this->model->findOrFail($id);
        $note->update([
            'text' => $text,
            'isEdit' => $isEdit,
        ]);
        return $note;
    }

    public function deleteNote($id): void
    {
        $note = $this->model->findOrFail($id);
        $note->delete();
    }
}
