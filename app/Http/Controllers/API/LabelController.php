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

        return $this->customResponse('result', LabelResource::collection($labels), Response::HTTP_OK);
    }

    public function store(LabelStoreRequest $request)
    {
        $statusCode = Response::HTTP_CREATED;
        $message = 'Label created successfully';

        $label = Label::create($request->validated());
        $data = new LabelResource($label);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function update(LabelUpdateRequest $request, Label $label)
    {
        $statusCode = Response::HTTP_OK;
        $message = 'Label updated successfully';

        $label->update($request->validated());
        $data = new LabelResource($label);

        return $this->customResponse($message, $data, $statusCode);
    }

    public function destroy(Label $label)
    {
        $statusCode = Response::HTTP_NO_CONTENT;
        $message = 'Label deleted successfully';

        $label->delete();

        return $this->customResponse($message, '', $statusCode);
    }
}
