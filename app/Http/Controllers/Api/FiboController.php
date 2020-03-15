<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FiboController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFibonacciSequence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required|integer',
            'to' => 'required|integer|min:' . ((int)$request->from + 1),
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toJson()], 422);
        }

        $result = [];
        foreach ($this->fibonacci($request->from, $request->to) as $fib) {
            $result[] = $fib;
        }

        return response()
            ->json(['data' => $result], 200);
    }

    /**
     * @param $from
     * @param $to
     * @return \Generator
     */
    function fibonacci($from, $to)
    {
        $a = 0;
        $b = 1;
        while ($to > 0) {
            if ($from > 0) {
                $from--;
            } else {
                yield $a;
            }

            $tmp = $a + $b;
            $a = $b;
            $b = $tmp;
            $to--;
        }
    }
}
