<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Label\LabelStoreRequest;
use App\Http\Requests\Label\LabelUpdateRequest;
use App\Http\Resources\Label\LabelResource;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::get();

        return response(LabelResource::collection($labels), Response::HTTP_OK);
    }

    public function store(LabelStoreRequest $request)
    {
        $label = Label::create($request->validated());

        return response(new LabelResource($label), Response::HTTP_CREATED);
    }

    public function update(LabelUpdateRequest $request, Label $label)
    {
        $label->update($request->validated());

        return response(new LabelResource($label), Response::HTTP_OK);
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return response([
            'message' => 'successfully deleted'
        ], Response::HTTP_NO_CONTENT);
    }
}
