<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhoneBooksResource;
use App\Models\phoneBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LVR\CountryCode\Two;


class PhoneBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phone_books = phoneBook::paginate(10);
        return PhoneBooksResource::collection($phone_books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $rules = [
               'first_name' => 'required|min:3',
               'last_name' => 'required|min:3',
               'phone_number'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
               'country_code'=>['required', new Two],
               'timezone_name'=>'timezone',
           ];
           $validator = Validator::make($request->all(),$rules);

           if($validator->fails()){
               $errors = $validator->errors();
               return $errors->toJson();
           }
            $phone_book = new phoneBook();
            $phone_book->first_name = $request->first_name;
            $phone_book->last_name = $request->last_name;
            $phone_book->phone_number = $request->phone_number;
            $phone_book->country_code = $request->country_code;
            $phone_book->timezone_name = $request->timezone_name;
            if($phone_book->save()){
                return new PhoneBooksResource($phone_book);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phone_book = phoneBook::findOrFail($id);
        return new PhoneBooksResource($phone_book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone_number'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'country_code'=>['required', new Two],
            'timezone_name'=>'timezone',
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            $errors = $validator->errors();
            return $errors->toJson();
        }
        $phone_book = phoneBook::findOrFail($id);
        $phone_book->first_name = $request->first_name;
        $phone_book->last_name = $request->last_name;
        $phone_book->phone_number = $request->phone_number;
        $phone_book->country_code = $request->country_code;
        $phone_book->timezone_name = $request->timezone_name;
        if($phone_book->save()){
            return new PhoneBooksResource($phone_book);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phone_book = phoneBook::findOrFail($id);
        if($phone_book->delete()){
            return new PhoneBooksResource($phone_book);
        }
    }
}
