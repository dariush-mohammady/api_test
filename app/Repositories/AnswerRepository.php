<?php

namespace App\Repositories;

use App\Answer;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerRepository
{

    public function getAllAnswers()
    {
        return Answer::query()->latest()->get();
    }

    public function store(Request $request)
    {
        Thread::find($request->thread_id)->answers()->create([

            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,

        ]);
    }


    public function update(Answer $answer, Request $request)
    {
        $answer->update([

            'content' => $request->input('content')

        ]);
    }

    public function delete(Answer $answer)
    {
        $answer->delete();
    }

}
