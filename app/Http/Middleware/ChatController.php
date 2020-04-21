<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    private $userData;

    public function chatList($id = null) {
        $this->userData = session()->get('user');
        if (is_null($id)) {
            $data = [
                'friendList' => $this->getFriendList(),
                'chatList' => $this->getChatList($this->userData['id']),
            ];
            $data['user'] =  User::find($this->userData['id']);
            return view('chat', $data);
        } else {
            $data['user'] =  User::find($this->userData['id']);
            $data['chatData'] =  $this->getChatList($this->userData['id']);
            var_dump($data);
            exit;
            // foreach ($chatData as $v) {
            //     if ($v->user_id)
            // }
            return view('private_chat', $data);
        }
    }
    
    public function privateChat() {
        return view('private_chat');
    }

    // Other func
    private function getFriendList() {
        return DB::select('SELECT f.id as bind_id, u.id as user_id, u.name
            FROM user_friend_operations as f, users as u
            WHERE f.status = "ok" 
            AND (f.owner_id = ? AND u.id = f.friend_id)
            OR (f.friend_id = ? AND u.id = f.owner_id)',
            [$this->userData['id'], $this->userData['id']]);
    }

    private function getChatList($id) {
        return DB::select('SELECT chats.id as chat_id, u.id as user_id, u.name
            FROM chats, users as u
            WHERE (chats.owner_id = ? AND u.id = chats.friend_id)
            OR (chats.friend_id = ? AND u.id = chats.owner_id)',
            [$id, $id]);
    }



}
