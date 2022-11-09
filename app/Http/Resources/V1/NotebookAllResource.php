<?php

namespace App\Http\Resources\V1;

use App\Models\Notebook;
use Illuminate\Http\Resources\Json\JsonResource;

class NotebookAllResource extends JsonResource
{
    public function toArray($request)
    {
        $result = [];
        $result[] = $this->resource->map(function (Notebook $notebook) {
            return [
                Notebook::NOTEBOOK_ID => $notebook->id,
                Notebook::NOTEBOOK_FULL_NAME => $notebook->full_name,
                Notebook::NOTEBOOK_EMAIL => $notebook->email,
                Notebook::NOTEBOOK_DATE_OF_BIRTH => $notebook->date_of_birth,
                Notebook::NOTEBOOK_PHOTO => $notebook->photo,
                Notebook::NOTEBOOK_COMPANY => $notebook->company,
                Notebook::NOTEBOOK_PHONE => $notebook->phone
            ];
        });

        return $result;
    }
}
