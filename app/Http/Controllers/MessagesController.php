<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Response;

class MessagesController extends Controller
{
    protected $perPage = 30;
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        if (Auth::user()->hasRole('user')) {
            $records = User::role('artist')
                ->where('id', '!=', Auth::id())
                ->where('name', 'LIKE', "%{$input}%")
                ->paginate($request->per_page ?? $this->perPage);
        } else {
            $records = User::where('id', '!=', Auth::id())
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'admin');
                })
                ->where('name', 'LIKE', "%{$input}%")
                ->paginate($request->per_page ?? $this->perPage);
        }
        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => Chatify::getUserWithAvatar($record),
            ])->render();
        }
        if($records->total() < 1){
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }
}
