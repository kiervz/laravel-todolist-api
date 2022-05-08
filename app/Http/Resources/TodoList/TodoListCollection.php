<?php

namespace App\Http\Resources\TodoList;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($request) {
                return [
                    'id' => $request->id,
                    'name' => $request->name,
                    'created_at' => $request->created_at,
                    'tasks' => TaskResource::collection($request->tasks)
                ];
            }),
            'meta' => [
                'total' => $this->total(),
                'page' => $this->currentPage(),
                'perPage' => (int) $this->perPage(),
                'totalPages' => $this->lastPage(),
                'path' => $this->path()
            ]
        ];
    }
}
