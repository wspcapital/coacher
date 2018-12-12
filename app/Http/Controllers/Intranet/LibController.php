<?php

namespace App\Http\Controllers\Intranet;

use App\Models\{
    Category,
    Lib
};
use App\Http\Controllers\Traits\AssetsTrait,
    Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy,
    App\Http\Requests\LibRequest;

/**
 * Class LibController
 * @package App\Http\Controllers\Intranet
 */
class LibController extends Controller
{
    use AssetsTrait;

    /**
     * Return view libs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLibs()
    {
        return view('intranet.libs')->with([
            'categories' => Category::where('type', 'Library')->where('parent_id', null)->where('blocked', '0')->get()
        ]);
    }

    /**
     * Update Post
     *
     * @param LibRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveLibCategory(LibRequest $request)
    {
        $category = Category::findOrFail($request->category_id);
        $category->update($request->all());

        Flashy::message('Category Library update');

        return redirect()->back();
    }

    /**
     * Update Post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveLib(Request $request)
    {
        $data = $request->all();
        $lib = Lib::findOrFail($request->lib_id);
        if (!$request->asset_id) {
            $data['asset_id'] = (empty($lib->asset_id)) ? null : $lib->asset_id;
        }
        $lib->update($data);

        Flashy::message('Library update');

        return redirect()->back();
    }

    /**
     * Create Library Category
     *
     * @param LibRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createLibCategory(LibRequest $request)
    {
        $newLibCategory = $request->all();
        $newLibCategory['type'] = 'Library';

        if (empty($newLibCategory['parent_id'])) {
            unset($newLibCategory['parent_id']);
        }

        $category = Category::create($newLibCategory);

        Flashy::message('Category create');
        return redirect('intranet/libs');
    }

    /**
     * Create Library
     *
     * @param LibRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createLib(LibRequest $request)
    {
        $lib = Lib::create($request->all());

        Flashy::message('Library item create');
        return redirect()->route('lib', $lib->id);
    }

    /**
     * @param $categoryId
     * @return $this
     */
    public function getNewLib($categoryId)
    {
        return view('intranet.new-lib')->with(['category' => $categoryId]);
    }

    /**
     * Return one Library
     *
     * @param Lib $lib
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOneLib(Lib $lib)
    {
        return view('intranet.lib')->with(['lib' => $lib]);
    }

    /**
     * Return View
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOneLibCategoryEdit(Request $request)
    {
        $parentId = (empty($request->parent_id)) ? null : $request->parent_id;
        if ($request->id === 'new') {
            return view('intranet.new-category')->with(['parent_category' => $parentId]);
        }

        $category = Category::findOrFail($request->id);

        return view('intranet.edit-category')->with(['category' => $category]);
    }

    /**
     * @param $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewCategoryLibs($category_id)
    {
        return view('intranet.new-category')->with(['parent_category' => $category_id ?? null]);
    }

    /**
     * Upload file
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadLibFile(Request $request)
    {
        return $this->uploadLibraryFile($request->file, $request->asset_id);
    }

    /**
     * Return view libs-child-category
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getChildrenCategoryLibs(Request $request)
    {
        return view('intranet.libs-child-category')->with([
            'category' => Category::findOrFail($request->id)
        ]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function searchLibs(Request $request)
    {
        $libs = Lib::search($request->keyword)->get();

        return view('intranet.partials.result-search-libs')->with(['libs' => $libs]);
    }
}
