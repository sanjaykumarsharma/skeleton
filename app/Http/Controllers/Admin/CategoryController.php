<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories',
            'image' => 'mimes:jpeg,png,jpg,JPG,JPEG,PNG'
        ]);

        //get form image

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //dd($imageName);
            //check if directory exists

            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            //resize image for category and upload

            $category = Image::make($image)->resize(1600,479)->save($imageName);
            Storage::disk('public')->put('category/'.$imageName,$category);

            //check if category slider exists

            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //resize image for category slider and upload

            $slider = Image::make($image)->resize(500,333)->save($imageName);
            Storage::disk('public')->put('category/slider/'.$imageName, $slider);

        }else
        {
            $imageName = 'default.png';
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();

        Toastr::success('Category Saved', 'succes');

        return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
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
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg,JPG,JPEG,PNG'
        ]);

        //get form image

        $image = $request->file('image');
        $slug = str_slug($request->name);

        $old_category = Category::find($id);

        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //dd($imageName);
            //check if directory exists

            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            //delete old category image
            if(Storage::disk('public')->exists('category/'.$old_category->image))
            {
                Storage::disk('public')->delete('category/'.$old_category->image);
            }

            //resize image for category and upload

            $category = Image::make($image)->resize(1600,479)->save($imageName);
            Storage::disk('public')->put('category/'.$imageName,$category);

            //check if category slider exists

            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            //delete old category slider image
            if(Storage::disk('public')->exists('category/slider/'.$old_category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$old_category->image);
            }

            //resize image for category slider and upload

            $slider = Image::make($image)->resize(500,333)->save($imageName);
            Storage::disk('public')->put('category/slider/'.$imageName, $slider);

        }else
        {
            $imageName = $old_category->image;
        }


        $old_category->name = $request->name;
        $old_category->slug = $slug;
        $old_category->image = $imageName;
        $old_category->save();

        Toastr::success('Category Saved', 'succes');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        //delete old category image
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }

        //delete old category image
        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();

        Toastr::success('Category Deleted', 'succes');

        return redirect()->back();
    }
}
