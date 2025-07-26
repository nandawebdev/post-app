<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category as Model;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{

    protected string $viewPath = 'category';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = Model::all();
        confirmDelete('Hapus data', 'Apakah anda yakin ingin menghapus data ini?', 'Hapus', 'Batal');
        return view($this->viewPath . '.index', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $id = $request->id;
        $request->validated();

        Category::updateOrCreate(
            ['id' => $id],
            [
                'category_name' => $request->category_name,
                'slug' => \Illuminate\Support\Str::slug($request->category_name),
                'description' => $request->description,
            ]
        );

        toast()->success('Berhasil', 'Data berhasil disimpan!');
        return redirect()->route('master-data.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        toast()->success('Data berhasil dihapus');
        return back();
    }
}
