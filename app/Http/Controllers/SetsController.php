<?php

namespace App\Http\Controllers;

use App\Movies;
use App\Sets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;


class SetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = sets::all(); //get all sets
        return view('admin.sets.index', compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //laravel validation
        $this->validate($request,
            [
                'title' => 'required',
                'image' => 'mimes:jpeg,bmp,png',
                'status' => 'required',
            ]
        );

        //check if the request has image
        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $filename = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('imgs/sets'))) {
                mkdir(public_path('imgs/sets'), 0777, true);
            }
            $path = public_path('imgs/sets/' . $filename);
            $img = Image::make($image->getRealPath());
            $img->save($path);
            $image = $filename;
        } else {
            $image = '';
        }
        //save set to database
        Sets::create([
            'title' => $request['title'],
            'image' => $image,
            'description' => $request['description'],
            'status' => $request['status'],
        ]);
        return redirect('admin/sets')->with('done','Set Created Successfully'); //redirect and show message
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $set = Sets::find($id); //fetch set record
        return view('admin.sets.edit', compact('set'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $set = Sets::find($id);
        $set->title = $request->title;
        $set->status = $request->status;
        $set->description = $request->description;

        /**
         * Image update

         */
        if (Input::hasFile('thumb')) { //thumb = file name in the view's form
            $image = Input::file('thumb');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('imgs/sets/' . $filename);
            $img = Image::make($image->getRealPath());
            $img->save($path);
            $set->image = $filename;
        }

        $set->save();

        return redirect('admin/sets')->with('done','Set Updated Successfully'); //redirect and show message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sets::destroy($id);

        return redirect('admin/sets')->with('done','Set Deleted Successfully'); //redirect and show message

    }

    /**
     * Changes Status Value .. if 1 then turn it to 0 else turn it to 1
     */
    public function changeStatus($id)
    {
        $set = Sets::where('id',  $id)->first(['status']);

        //check status value  to update it
        if($set->status == 0 ){
            Sets::where('id',$id)->update(['status'=>1]);

        }else{
            Sets::where('id',$id)->update(['status'=>0]);
        }

        return redirect('admin/sets')->with('done','Set Status Changed Successfully'); //redirect and show message

    }

}

