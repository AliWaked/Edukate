<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'user' => [
                'user_type' => (new $this->user_type instanceof Admin) ? 'admin' : 'instructor',
                'user_id' => $this->id,
                'user_name' => $this->user->name,
            ]
        ];
    }
}
