<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    private $userData;

    public function chatList($id = null) {
        $this->userData = session()->get('user');
        if (is_null($id)) {
            $data = [
                // 'friendList' => $this->getFriendList(),
                'chatList' => $this->getChatList($this->userData['id']),
            ];
            $data['user'] =  User::find($this->userData['id']);
            return view('chat', $data);
        } else {
            $data['user'] =  User::find($this->userData['id']);
            $data['chatId'] = $id;
            $chatData =  DB::table('chats')->where('id', $id)->get();
            $userId = null;
            foreach ($chatData as $val) {
                if ($val->owner_id == $this->userData['id']) {
                    $userId = $val->friend_id;
                } elseif ($val->friend_id == $this->userData['id']) {
                    $userId = $val->owner_id;
                }
            }
            $data['chatData'] = DB::table('users')->where('id', $userId)->select('id', 'name')->first();
            // foreach ($chatData as $v) {
            //     if ($v->user_id)
            // }
            return view('private_chat', $data);
        }
    }

    public function privateChat($id=null) {

        $this->userData = session()->get('user');
        $data = [
            'user' => User::find($this->userData['id']),
            'chatId' => $id,
            'chatList' => $this->buildChatListWithMsg($id),
            'confList'=> DB::table('conferences')->where('user_id', $this->userData['id'])->get(),
            'friendList' => $this->getFriendList($this->userData['id']),
        ];
        $ff = $data['chatList'] + $data['friendList'];
        if (!is_null($id)) {
            $data['msgList'] = $this->getChatMsg($id);
            $chatData =  DB::table('chats')->where('id', $id)->get();
            $userId = null;
            foreach ($chatData as $val) {
                if ($val->owner_id == $this->userData['id']) {
                    $userId = $val->friend_id;
                } elseif ($val->friend_id == $this->userData['id']) {
                    $userId = $val->owner_id;
                }
            }
            $data['chatData'] = DB::table('users')->where('id', $userId)->select('id', 'name', 'avatar')->first();
        } else {
            $data['chatData'] = null;
        }
        return view('new_chat', $data);
    }

    // Other func
    private function getFriendList($id) {
        return DB::select('SELECT f.id as bind_id, u.id as user_id, u.name, u.avatar
            FROM user_friend_operations as f, users as u
            WHERE f.status = "ok"
            AND (f.owner_id = ? AND u.id = f.friend_id)
            OR (f.friend_id = ? AND u.id = f.owner_id)',
            [$id, $id]);
    }

    private function getChatList($id) {
        return DB::select('SELECT chats.id as chat_id, u.id as user_id, u.name, u.avatar
            FROM chats, users as u
            WHERE (chats.owner_id = ? AND u.id = chats.friend_id)
            OR (chats.friend_id = ? AND u.id = chats.owner_id)',
            [$id, $id]);
    }

    private function getChatMsg($id) {
        $llen = Redis::llen('private_chat_'.$id);
        return Redis::lrange('private_chat_'.$id, 0, (int)$llen);
    }

    private function getLastChatMsg($id) {
        $list = Redis::lrange('private_chat_'.$id, 0, 0);
        // var_dump($list);
        // exit;
        if (is_null($list)) {
            return null;
        } else {
            // $json = json_encode($list[0]);
            var_dump($list);
            exit;
            $arr = json_decode($list, true);
            return $arr['msg'];
        }
    }

    public function buildChatListWithMsg($chatId) {
        if(is_null($chatId)) {
            return $this->getChatList($this->userData['id']);
        } else {
            $chatList = $this->getChatList($this->userData['id']);
            foreach ($chatList as $k => $v) {
                $chatList[$k]->chat_id != $chatId ? $chatList[$k]->isActive = 0 : $chatList[$k]->isActive = 1;
                $chatList[$k]->lastMsg = 12;
            }
            return $chatList;
        }
    }

}
