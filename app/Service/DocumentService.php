<?php

namespace App\Service;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    public function getAll()
    {
        return Document::orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get();
    }

    public function getOne($document_id)
    {
        return Document::find($document_id);
    }

    public function create(DocumentRequest $request)
    {
        $data = $request->validated();
        $data['file'] = $request->file('file')->store('documentFiles', 'public');
        $data['image'] = $request->file('image')->store('documentImages', 'public');
        return Document::create($data);
    }

    public function update(DocumentRequest $request, $document_id)
    {
        $data = $request->validated();
        $document = Document::find($document_id);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete("documentFiles/" . basename($document->file));
            $data['file'] = $request->file('file')->store('documentFiles', 'public');
        }

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete("documentImages/" . basename($document->image));
            $data['image'] = $request->file('image')->store('documentImages', 'public');
        }

        $document->update($data);
        return $document;
    }

    public function delete($document_id): void
    {
        $document = Document::find($document_id);
        Storage::disk('public')->delete("documentFiles/" . basename($document->file));
        Storage::disk('public')->delete("documentImages/" . basename($document->image));
        $document->delete();
    }
}
