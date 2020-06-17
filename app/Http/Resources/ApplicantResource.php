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
            'name' => $this->name,
            'photo' => $this->photo,
            'nrc' => $this->nrc,
            'dob' => $this->dob,
            'age' => $this->age,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'education' => $this->education,
            'working_experience' => $this->working_experience,
            'is_chatesat_freelancer' => $this->is_chatesat_freelancer,
            'referral_code' => $this->referral_code,
            'cv_attachment' => $this->cv_attachment,
            'is_webinar_available' => $this->is_webinar_available,
            'is_training_available' => $this->is_training_available,
            'is_prudential_available' => $this->is_prudential_available,
            'status_id' => $this->status_id,
            'status' => $this->status->title,
            'reason_id' => $this->reason_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
