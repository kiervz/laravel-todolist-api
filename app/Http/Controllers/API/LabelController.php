<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Label\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();

        return response($labels);
    }

    public function store(LabelRequest $request)
    {
        $label = Label::create([
            'title' => $request['title'],
            'color' => $request['color']
        ]);

        return response($label, 201);
    }
}
