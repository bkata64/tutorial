<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Name;
use Exception;
use Illuminate\Http\Request;

class TesztController extends Controller
{
    public function teszt()
    {
        $names = [
            'Traza',
            'Beep',
            'Zsó',
            'Musla',
            'D3n',
            'Nekokota',
            'Nhilerion'
        ];
        $randomNameKey = array_rand($names, 1);
        $randomName = $names[$randomNameKey];

        return view('pages.teszt', compact('randomName'));
    }

    public function names()
    {
        $names = Name::all();
        $families = Family::all();
        return view('pages.names', compact('names', 'families'));
    }

    public function namesCreate($family, $name)
    {
        $nameRecord = new Name();
        $nameRecord->name = $name;
        $nameRecord->family_id = $family;
        $nameRecord->save();

        return $nameRecord->id;
    }

    public function familyCreate($name)
    {
        $familyRecord = new Family();
        $familyRecord->surname = $name;
        $familyRecord->save();

        return $familyRecord->id;
    }

    public function deleteName(Request $request)
    {
        $name = Name::find($request->input('id'));
        $name->delete();

        return "ok";
    }

    public function manageSurname()
    {
        $names = Family::all();
        return view('pages.surname', compact('names'));
    }

    public function deleteSurname(Request $request)
    {
        try {

            $name = Family::find($request->input('id'));
            $name->delete();
            return response()->json(['success' => true]);
        }
        catch (Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return "ok";
    }

    public function newSurname(Request $request)
    {
        $validatedData = $request->validate([
            'inputFamily' => 'required|alpha|min:2|max:20',
        ]);
        $familyRecord = new Family();
        $familyRecord->surname =  $validatedData['inputFamily'];
        $familyRecord->save();

        return redirect("/names/manage/surname");
    }

    public function newName(Request $request)
    {
        $validatedData = $request->validate([
            'inputFamily' => 'required|integer|exists:App\Models\Family,id',
            'inputName' => 'required|alpha|min:2|max:20',
        ]);

        $name = new Name();
        $name->family_id = $validatedData['inputFamily'];
        $name->name = $validatedData['inputName'];
        $name->save();

        return redirect("/names");
    }
}
