<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource_khach_hang extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'email' => $this->email,
            'sdt' => $this->sdt,
            'mat_khau' => $this->mat_khau,
            'ho_ten' => $this->ho_ten,
            'dia_chi' => $this->dia_chi,
            'chuc_vu' => $this->chuc_vu,
        ];
    }
}
