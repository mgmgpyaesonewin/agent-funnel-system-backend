<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->admin);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'gender' => $this->gender,
            'current_status' => $this->current_status,
            'status_id' => $this->status_id,
            'admin' => new UserResource($this->admin),
            'bdm' => new UserResource($this->bdm),
            'ma' => new UserResource($this->ma),
            'staff' => new UserResource($this->staff),
        ];
    }
}
