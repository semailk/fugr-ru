<?php

namespace App\Http\Resources\V1;

use App\Models\Notebook;
use Illuminate\Http\Resources\Json\JsonResource;

class NotebookOneResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Notebook::NOTEBOOK_ID => $this->resource->id,
            Notebook::NOTEBOOK_FULL_NAME => $this->resource->full_name,
            Notebook::NOTEBOOK_EMAIL => $this->resource->email,
            Notebook::NOTEBOOK_DATE_OF_BIRTH => $this->resource->date_of_birth,
            Notebook::NOTEBOOK_PHOTO => $this->resource->photo,
            Notebook::NOTEBOOK_COMPANY => $this->resource->company,
            Notebook::NOTEBOOK_PHONE => $this->resource->phone
        ];
    }
}
