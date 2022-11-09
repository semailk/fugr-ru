<?php

namespace App\Services;

use App\Models\Notebook;
use Illuminate\Support\Facades\File;

class NotebookService
{
    /**
     * @param $request
     * @return Notebook
     */
    public function notebookStoreService($request): Notebook
    {
        $photoPath = '';
        if ($request->has('photo') && !empty($request->photo)) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $newNotebook = new Notebook();
        $newNotebook->phone = $request->phone;
        $newNotebook->company = $request->company;
        $newNotebook->date_of_birth = $request->date_of_birth;
        $newNotebook->photo = $photoPath;
        $newNotebook->email = $request->email;
        $newNotebook->full_name = $request->full_name;
        $newNotebook->save();

        return $newNotebook;
    }

    /**
     * @param $notebook
     * @param $request
     * @return Notebook
     */
    public function notebookUpdateService($notebook, $request): Notebook
    {
        $photoPath = '';
        if ($request->has('photo') && !empty($request->photo)) {
            File::delete('storage/' . $notebook->photo);
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        /** @var Notebook $notebook */
        $notebook->phone = $request->phone;
        $notebook->company = $request->company;
        $notebook->date_of_birth = $request->date_of_birth;
        $notebook->photo = $photoPath;
        $notebook->email = $request->email;
        $notebook->full_name = $request->full_name;
        $notebook->save();

        return $notebook;
    }
}
