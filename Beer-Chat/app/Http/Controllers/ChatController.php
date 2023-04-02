<?php

    namespace App\Http\Controllers;

    use App\Events\MessageDelete;
    use App\Events\MessageSend;
    use App\Models\Chat;
    use App\Models\Message;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;


    class ChatController extends Controller
    {
        public function chat(string $chat_id): Collection|array
        {
            return Message::query()
                ->where('chat_id', '=', $chat_id)
                ->with('user')
                ->get();
        }

        public function store(Request $request)
        {
            $request->validate(
                [
                    'user_id' => ['required', 'int'],
                    "second_user_id" => ['required', 'int']
                ]
            );
            $chat = Chat::where(
                function ($query) use ($request) {
                    $query->where('first_user_id', '=', $request->user_id)
                        ->where('second_user_id', '=', $request->second_user_id);
                }
            )->orWhere(
                function ($query) use ($request) {
                    $query->where('second_user_id', '=', $request->user_id)
                        ->where('first_user_id', '=', $request->second_user_id);
                }
            )->get();
            if (count($chat) == 0) {
                return Chat::create(
                    [
                        "first_user_id" => $request->user_id,
                        "second_user_id" => $request->second_user_id,
                    ]
                );
            }
            return $chat->first();
        }
    }
