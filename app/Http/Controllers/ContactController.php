<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas= DB::table('contacts')->simplePaginate(10);
        return view ('contacts', ['datas'=>$datas]);
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('contact_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request-> validate([
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'email' => 'required|email|max:100',
            'mobile' => 'required|max:10',
            'password' => 'required|min:8|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data= DB::table('contacts')->insert([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
            'profile_pic' => $request->file('profile_pic') ? $request->file('profile_pic')->store('profile_pics', 'public') : null,
        ]);

        if($data){
            return redirect()->route('contacts.index');
        }

        return redirect() ->route('contacts.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data= DB::table('contacts')-> find($id);
        return view('single_contact', ['data' => $data]);
    }

    public function image(string $id)
    {
        $contact = DB::table('contacts')->find($id);

        if (! $contact || ! $contact->profile_pic) {
            abort(404);
        }

        $profilePic = str_replace('\\', '/', $contact->profile_pic);
        $profilePic = preg_replace('#^storage/#', '', $profilePic);

        if (Storage::disk('public')->exists($profilePic)) {
            return Storage::disk('public')->response($profilePic);
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $data= DB::table('contacts')-> find($id);
         return view ('update_contact_form', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request-> validate([
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'email' => 'required|email|max:100',
            'mobile' => 'required|max:10',
            'password' => 'nullable|min:8|max:20',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $contact = DB::table('contacts')->find($id);

        if (! $contact) {
            return redirect()->route('contacts.index');
        }

        $profilePic = $contact->profile_pic;

        if ($request->hasFile('profile_pic')) {
            if ($profilePic) {
                Storage::disk('public')->delete($profilePic);
            }

            $profilePic = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $contactData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'profile_pic' => $profilePic,
        ];

        if ($request->filled('password')) {
            $contactData['password'] = bcrypt($request->password);
        }

        $update= DB::table('contacts')->where('id', '=' , $id)->update($contactData);

        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete= DB::table('contacts')->where('id', '=' , $id)->delete();

        if($delete){
            return redirect()->route('contacts.index');
        }

        return redirect() ->route('contacts.index');
    }
}
