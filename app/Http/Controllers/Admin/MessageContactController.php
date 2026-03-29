<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyContactMessageRequest;
use App\Mail\ReplyToContactMessage;
use App\Models\MessageContact;
use App\Models\MessageContactReply;
use App\Models\ParametresSite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class MessageContactController extends Controller
{
    public function index()
    {
        $messages = MessageContact::latest()->paginate(20);
        $nonLus = MessageContact::where('lu', false)->count();

        return view('admin.messages.index', compact('messages', 'nonLus'));
    }

    public function show(MessageContact $messageContact)
    {
        if (! $messageContact->lu) {
            $messageContact->update(['lu' => true]);
        }
        $contactReplyClosing = ParametresSite::instance()->resolvedContactReplyClosing();
        $sentReplies = $messageContact->sentReplies()->with('user:id,name')->latest()->get();
        $sentRepliesByIdForJs = $sentReplies->keyBy('id')->map(fn ($r) => [
            'body' => $r->body,
            'sentAt' => $r->created_at->format('d/m/Y à H:i'),
            'author' => $r->user?->name ?? '—',
        ]);

        return view('admin.messages.show', compact(
            'messageContact',
            'contactReplyClosing',
            'sentReplies',
            'sentRepliesByIdForJs',
        ));
    }

    public function markAsRead(MessageContact $messageContact)
    {
        $messageContact->update(['lu' => true]);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message marqué comme lu.');
    }

    public function destroy(MessageContact $messageContact)
    {
        $messageContact->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé.');
    }

    public function reply(ReplyContactMessageRequest $request, MessageContact $messageContact): RedirectResponse
    {
        $user = $request->user();
        $replyClosing = ParametresSite::instance()->resolvedContactReplyClosing();

        Mail::to($messageContact->email)->send(new ReplyToContactMessage(
            contactName: $messageContact->name,
            replyBody: $request->validated('body'),
            originalSubject: $messageContact->subject,
            originalMessage: $messageContact->message,
            replyToEmail: $user->email,
            replyToName: $user->name,
            replyClosing: $replyClosing,
        ));

        MessageContactReply::create([
            'message_contact_id' => $messageContact->id,
            'user_id' => $user->id,
            'body' => $request->validated('body'),
        ]);

        return back()->with('success', 'Réponse envoyée par e-mail à l’expéditeur.');
    }
}
