<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\SupportConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportConversationController extends Controller
{
    // GET /conversations  (admin: tất cả; customer: chỉ của mình)
    public function index(Request $request)
    {
        $user = $request->user();

        if (($user->role ?? null) === 'admin') {
            $convs = SupportConversation::query()
                ->withCount('messages')
                ->orderByDesc('conversation_id')
                ->paginate(20);
        } else {
            // customer: join sang tickets để lọc theo chủ ticket (user_id = current user)
            $convs = SupportConversation::query()
                ->select('support_conversations.*')
                ->join('support_tickets as t', 't.ticket_id', '=', 'support_conversations.ticket_id')
                ->where('t.user_id', $user->user_id)
                ->withCount('messages')
                ->orderByDesc('support_conversations.conversation_id')
                ->paginate(20);
        }

        return response()->json($convs);
    }
}
