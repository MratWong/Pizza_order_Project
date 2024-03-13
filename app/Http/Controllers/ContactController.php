<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // contact home page
    public function contactHomePage(){
        $message = Contact::first();
        return view('user.contact.home',compact('message'));
    }

    // contact chat page
    public function contactChatPage($message){
        $message = Contact::where('message',$message)->first();
        return view('user.contact.chat',compact('message'));
    }

    // admin contact page
    public function messageList(){

        $data = Contact::with('senderUser', 'receiverUser')
            ->where('receiver_id', 0)
            ->orderBy('id', 'desc')
            ->groupBy('sender_id')
            ->get();

        // return $data;

        return view('admin.account.contact', compact('data'));
    }

    // admin view message
    public function messageView($user_id) {

        $contacts = Contact::with('senderUser', 'receiverUser')
                        ->where(function ($q) use($user_id) {
                            $q->where('sender_id', $user_id)
                                ->orWhere('receiver_id', $user_id);
                        })
                        ->get();
        
        // return $contacts;

        $user = User::find($user_id);

        return view('admin.account.messageReply',compact('contacts', 'user'));
    }

    public function messageReply(Request $request) {

        logger($request->all());

        $contact = Contact::create([
            'receiver_id'   => $request->receiver_id,
            'message'=>$request->replyMessage
        ]);

        return $contact;

    }

}
