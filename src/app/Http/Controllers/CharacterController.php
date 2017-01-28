<?php

namespace Medusa\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Medusa\App\Characters;
use Medusa\App\CharactersMeta;
use App\Http\Requests\CreateCharacterRequest;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!isLoggedIn())
            return view('auth.login');

        $data = [
            'characters'    =>  Characters::getCharacters()
        ];

        return view('characters.choose', $data);
    }
    
    /**
     * Display the choose character page
     *
     * @return mixed
     */
    public function choose()
    {
        $data = [
            'characters'    =>  Characters::getCharacters()
        ];

        return view('characters.choose', $data);
    }

    /**
     * Play as the specified character
     */
    public function postChoose(Request $request)
    {
        $id = $request->input('cid');

        $char = Characters::where('uid', '=', user()->id)
            ->findOrFail($id);

        session([
            'cid'   =>  $char->id
        ]);

        return redirect()->route('home');
    }

    /**
     * Create a new character
     *
     * @param CreateCharacterRequest $request
     */
    public function postNew(CreateCharacterRequest $request)
    {

        // Create the character
        $char = new Characters();
        $char->displayname = $request->input('displayname');
        $char->uid = user()->id;
        $char->save();

        // Set character ID
        session(['cid' => $char->id]);

        //Insert some default meta
        $defaultMeta = [
            'rank'      =>  1,
            'bullets'   =>  0,
            'health'    =>  100,
        ];

        CharactersMeta::set($defaultMeta);
    }
}
