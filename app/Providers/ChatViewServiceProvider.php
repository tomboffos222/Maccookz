<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ChatViewServiceProvider extends ServiceProvider
{
    
    public function register() {
        //
    }

    public function boot() {
        View::composer('*', function ($view) {
            if (session()->has('user')) {
                $user = session()->get('user');
                $view->with('composeUserId', $user['id']);
                $view->with('composeChatList', $this->getChatList($user['id']));
            }
        });
    }

    private function getChatList($id) {
        return DB::select('SELECT chats.id as chat_id, u.id as user_id, u.name
            FROM chats, users as u
            WHERE (chats.owner_id = ? AND u.id = chats.friend_id)
            OR (chats.friend_id = ? AND u.id = chats.owner_id)',
            [$id, $id]);
    }
}