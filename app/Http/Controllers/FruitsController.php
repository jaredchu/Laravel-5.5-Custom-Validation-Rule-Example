<?php

namespace App\Http\Controllers;

use App\Fruits;
use App\Rules\ExistsID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FruitsController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'fruits' => [
                'required',
                'array',
                new ExistsID('fruits', 'id')
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return (array)$validator->messages();
        }

        return Fruits::on()->whereIn('id', $request->get('fruits'))->get();
    }
}
