<?php

namespace App\Http\Controllers;

use App\Sets;
use App\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = Sets::select('id','title'); //gets sets id and title
        $movies = Movies::all(); //get all movies
        return view('admin.movies.index', compact('movies','sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sets = Sets::all(); //get all sets (to show them in dropdown list)
        return view('admin.movies.create',compact('sets'));
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
                'set_id' => 'required',
                'image' => 'mimes:jpeg,bmp,png',
                'status' => 'required',
                'created_date' => 'required',
            ]
        );

        //check if the request has image
        if (Input::hasFile('image')) {
            $image = Input::file('image');
            $filename = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            if (!file_exists(public_path('imgs/movies'))) {
                mkdir(public_path('imgs/movies'), 0777, true);
            }
            $path = public_path('imgs/movies/' . $filename);
            $img = Image::make($image->getRealPath());
            $img->save($path);
            $image = $filename;
        } else {
            $image = '';
        }

        //save movie to database
        Movies::create([
            'set_id' => $request->set_id,
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'created_date' => $request->created_date,
            'status' => $request->status,
        ]);
        return redirect('admin/movies')->with('done','Movie Created Successfully'); //redirect and show message
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
        $sets = Sets::all(); //get all sets (to show them in dropdown list)
        $movie = Movies::find($id); //fetch movie record
        return view('admin.movies.edit', compact('movie','sets'));
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
        $movie = Movies::find($id);
        $movie->set_id = $request->set_id;
        $movie->title = $request->title;
        $movie->status = $request->status;
        $movie->created_date = $request->created_date;
        $movie->description = $request->description;

        /**
         * Image update

         */
        if (Input::hasFile('thumb')) { //thumb = file name in the view's form
            $image = Input::file('thumb');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('imgs/movies/' . $filename);
            $img = Image::make($image->getRealPath());
            $img->save($path);
            $movie->image = $filename;
        }
        $movie->save();

        return redirect('admin/movies')->with('done','Movie Updated Successfully'); //redirect and show message
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movies::destroy($id);

        return redirect('admin/movies')->with('done','Movie Deleted Successfully'); //redirect and show message

    }

    /**
     * Changes Status Value .. if 1 then turn it to 0 else turn it to 1
     */
    public function changeStatus($id)
    {
        $movie = Movies::where('id',  $id)->first(['status']); //get status of that movie

        //check status value  to update it
        if($movie->status == 0 ){
            Movies::where('id',$id)->update(['status'=>1]);

        }else{
            Movies::where('id',$id)->update(['status'=>0]);
        }

        return redirect('admin/movies')->with('done','Movie Status Changed Successfully'); //redirect and show message

    }

}
