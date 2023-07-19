<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'notification_type' => $this->notification_type,
            'message' => $this->message,
            'is_read' => $this->is_read,
            'created_at' => $this->created_at,
            'quote' => $this->quote,
            'sender' => new UserResource($this->whenLoaded('sender')),
        ];
    }
}
