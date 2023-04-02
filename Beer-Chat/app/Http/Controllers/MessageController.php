<?php

    namespace App\Http\Controllers;

    use App\Events\MessageDelete;
    use App\Events\MessageSend;
    use App\Models\Message;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Validation\ValidationException;

    class MessageController extends Controller
    {
        public function store(Request $request): Message
        {
            $request->validate(
                [
                    'message' => ['required', 'string', 'min:1']
                ]
            );

            $message = Message::create(
                [
                    "text" => $request->message,
                    "chat_id" => 1,
                    "user_id" => Auth::id(),
                ]
            );
            $message->user = Auth::user();
            broadcast(new MessageSend($request->user(), $message));
            return $message;
        }

        public function delete(string $message_id)
        {
            $message = Message::where('id', $message_id)->first();
            if ($message !== null) {
                broadcast(new MessageDelete($message));
                $res = $message->delete();
                if ($res) {
                    return $message;
                }
            }
            throw ValidationException::withMessages(
                [
                    'message_id' => ['message is not defined'],
                ]
            );
        }
    }
