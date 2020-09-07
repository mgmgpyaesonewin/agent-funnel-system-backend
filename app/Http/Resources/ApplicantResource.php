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
        return [
            'id' => $this->id,
            'temp_id' => $this->temp_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'gender' => $this->gender,
            'exam_date' => $this->exam_date,
            'aml_status' => $this->aml_check,
            'current_status' => $this->current_status,
            'status_id' => $this->status_id,
            'admin' => new UserResource($this->admin),
            'bdm' => new UserResource($this->bdm),
            'ma' => new UserResource($this->ma),
            'staff' => new UserResource($this->staff),
            'partner' => new PartnerResource($this->partner),
            'payment' => validate_asset($this->payment),
            'license' => validate_asset($this->license_photo_1),
            'contract' => validate_asset($this->pdf),
        ];
    }
}
