<?php

    namespace App\Http\Controllers;

    use App\Events\MessageSend;
    use App\Models\Chat;
    use App\Models\Message;
    use Illuminate\Broadcasting\BroadcastException;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;


    class ChatController extends Controller
    {
        public function getAllChats($user_id): Collection|string
        {
            try {
                return Chat::where(
                    "first_user_id",
                    $user_id
                )->orWhere("second_user_id", $user_id)->with("from")->with("to")->get();
            } catch (QueryException $ex) {
                Log::error($ex);
                abort(405);
            } catch (\Exception $ex) {
                Log::error($ex);
                abort(501);
            }
            return "error";
        }

        public function store(Request $request): Chat
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
            )->with("messages.user")->get();
            if (count($chat) == 0) {
                $chat = Chat::create(
                    [
                        "first_user_id" => $request->user_id,
                        "second_user_id" => $request->second_user_id,
                    ]
                );
                $chat->messages = [];
                return $chat;
            }
            return $chat->first();
        }
    }
