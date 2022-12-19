<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersExportResource extends JsonResource
{

    public function __construct($resource)
    {
        // Ensure we call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource; // $apple param passed
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $permissionsNames = $this->permissionsNames();

        return [
            'id' => (int) $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'status' => $this->status ? 'Active' : 'Blocked',
            'permissions' => !count($permissionsNames) ?  "No permissions" : implode(' , ', $permissionsNames),
            'created_at' => $this->created_at,

        ];
    }
}
