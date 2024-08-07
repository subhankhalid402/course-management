<?php

namespace App\Http\Controllers;

use App\Helpers\SiteHelper;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private $logged_in_user_id = 1;

    public function index()
    {
        $chats = Chat::with(['messages'])
            ->where('first_user_id', SiteHelper::getLoginUserId())
            ->orWhere('second_user_id', SiteHelper::getLoginUserId());

        if (session()->get('role') == 'vendor') {
            $chats = $chats->where('status', '=', 'accepted');
        } else {
            $chats = $chats->where('status', '!=', 'rejected');
        }

        $chats = $chats->get();

        foreach ($chats as $chat) {
            if ($chat->messages) {
                foreach ($chat->messages as $message) {
                    $message->update(['is_delivered' => true]);
                }
            }
        }

        return view('chats.list')->with([
            'chats' => $chats,
            'login_user_id' => SiteHelper::getLoginUserId()
        ]);
    }

    public function getAcceptedUserForChat(Request $request)
    {
        $chats = Chat::with(['messages'])
            ->where('first_user_id', SiteHelper::getLoginUserId())
            ->where('status', '!=', 'rejected')
            ->orWhere('second_user_id', SiteHelper::getLoginUserId())
            ->get();

        return response()->json([
            'status' => true,
            'data' => $chats
        ]);
    }

    public function initiateChat(Request $request)
    {
        if (!empty($request->user_id)) {

            $Chat = Chat::create([
                'status' => 'requested',
                'second_user_id' => $request->user_id,
                'first_user_id' => SiteHelper::getLoginUserId(),
                'initiated_by' => SiteHelper::getLoginUserId(),
            ]);

            $User = User::find(1);


            return response()->json([
                'status' => true,
                'message' => "Request send successfully"
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Empty"
        ]);
    }

    public function sendMessage(Request $request)
    {
        $Message = Message::create([
            'sender_id' => SiteHelper::getLoginUserId(),
            'receiver_id' => $request->user_id,
            'message' => $request->message,
            'chat_id' => $request->chat_id,
            'is_readed' => 0,
            'sended_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => "Message Sent Successfully",
            'data' => $Message
        ]);
    }

    public function markMessagesAsRead(Request $request)
    {
        Message::where('chat_id', $request->id)->update([
            'is_readed' => 1,
            'readed_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => "Done"
        ]);

    }

    public function getNewMessages(Request $request)
    {
        $chats = Chat::with(['messages' => function ($message) {
            $message->where('is_delivered', 0)->where('sender_id', '!=', SiteHelper::getLoginUserId());
        }])
            ->where('first_user_id', SiteHelper::getLoginUserId())
            ->orWhere('second_user_id', SiteHelper::getLoginUserId())
            ->get();

        foreach ($chats as $chat) {
            if ($chat->messages) {
                foreach ($chat->messages as $message) {
                    $message->update(['is_delivered' => true]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => $chats,
            'login_user_id' => SiteHelper::getLoginUserId()
        ]);
    }

    public function acceptOrRejectChat(Request $request)
    {
        $request->validate([
            'chat_id' => 'required',
            'status' => 'required'
        ]);

        Chat::where('id', $request->chat_id)->update(['status' => $request->status]);

        return response()->json([
            'status' => true,
            'message' => 'Chat has been ' . $request->status
        ]);
    }

    public function markMessagesAsReadAll()
    {
        Message::where('receiver_id', SiteHelper::getLoginUserId())->update([
            'is_readed' => 1,
            'readed_at' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => "Done"
        ]);
    }

    public function invitedInfluencer()
    {
        $role = session()->get('role');

        $Chats = Chat::with('first_user', 'second_user')->when($role == 'vendor', function ($Chat) {
            $Chat->where('first_user_id', SiteHelper::getLoginUserId());
        })->when($role == 'influencer', function ($Chat) {
            $Chat->where('second_user_id', SiteHelper::getLoginUserId())->where('status', 'requested');
        })->get();

        return view('chats.invited-influencer')->with('data', $Chats);
    }

    public function statusUpdate(Request $request)
    {
        $Chat = Chat::where('id', $request->chat_id)->update(['status' => $request->status]);

        return response()->json([
            'status' => true,
            'message' => "invitation $request->status successfully"
        ]);
    }
}
