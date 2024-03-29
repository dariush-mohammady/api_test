<?php

namespace App\Http\Controllers\Api\v1\Thread;

use App\Thread;
use App\Http\Controllers\Controller;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{

    public function index()
    {

        $threads = resolve(ThreadRepository::class)->getAllAvailableThreads();

        return response()->json($threads, Response::HTTP_OK);
    }

    public function show($slug)
    {
        $thread = resolve(ThreadRepository::class)->getThreadBySlug($slug);

        return response()->json($thread, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => ['required'],
            'content' => ['required'],
            'channel_id' => ['required'],

        ]);


        resolve(ThreadRepository::class)->store($request);

        return response()->json([
            'message' => 'thread created successfully'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Thread $thread)
    {
        $request->has('best_answer_id')

            ?

            $request->validate([

                'best_answer_id' => ['required']

            ])


            :

            $request->validate([

                'title' => ['required'],
                'content' => ['required'],
                'channel_id' => ['required'],

            ]);

        if (Gate::forUser(auth()->user())->allows('user-thread', $thread)) {

            resolve(ThreadRepository::class)->update($thread, $request);


            return response()->json([
                'message' => 'thread updated successfully'
            ], Response::HTTP_OK);
        }


        return response()->json([
            'message' => 'access denied!'
        ], Response::HTTP_FORBIDDEN);
    }

    public function destroy(Thread $thread)
    {

        if (Gate::forUser(auth()->user())->allows('user-thread', $thread)) {

            resolve(ThreadRepository::class)->destroy($thread);

            return response()->json([

                'message' => 'Thread deleted successfully'

            ], Response::HTTP_OK);
        }

        return response()->json([

            'message' => 'ACCESS DENIED!!'

        ], Response::HTTP_FORBIDDEN);
    }
}
