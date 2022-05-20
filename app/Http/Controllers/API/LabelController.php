<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Label\LabelStoreRequest;
use App\Http\Requests\Label\LabelUpdateRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();

        return response($labels);
    }

    public function store(LabelStoreRequest $request)
    {
        $label = Label::create($request->validated());

        return response($label, 201);
    }

    public function update(LabelUpdateRequest $request, Label $label)
    {
        $label->update($request->validated());

        return response($label);
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return response([
            'message' => 'successfully deleted'
        ], Response::HTTP_NO_CONTENT);
    }
}
