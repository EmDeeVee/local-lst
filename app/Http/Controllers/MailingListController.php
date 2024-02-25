<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailingListController extends Controller
{
    // get data
    public function index() {
        $mailingLists = MailingList::all();
        return response()->json($mailingLists, Response::HTTP_OK);
    }

    // // post data
    // public function store(Request $request) {
    //     $validData = $request->validate([
    //         'list_name' => 'required|max:255'
    //     ]);

    //     $mailingList = new MailingList([
    //         'list_name' => $validData['list_name']
    //     ]);

    //     $mailingList->save();

    //     return response()->json($mailingList, Response::HTTP_CREATED);
    // }
}
