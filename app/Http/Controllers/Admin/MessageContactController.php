<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{
    public function index()
    {
        $messages = MessageContact::latest()->paginate(20);
        $nonLus   = MessageContact::where('lu', false)->count();
        return view('admin.messages.index', compact('messages', 'nonLus'));
    }

    public function show(MessageContact $messageContact)
    {
        if (! $messageContact->lu) {
            $messageContact->update(['lu' => true]);
        }
        return view('admin.messages.show', compact('messageContact'));
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
}
