<?php

namespace Modules\PkgProjets\Controllers;

use Modules\PkgProjets\App\Exceptions\ProjectAlreadyExistException;
use App\Http\Controllers\Controller;
use Modules\PkgProjets\App\Imports\ProjetImport;
use Modules\PkgProjets\Models\Projet;
use Illuminate\Http\Request;
use Modules\PkgProjets\App\Requests\projetRequest;
use Modules\PkgProjets\Repositories\ProjetRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Modules\PkgProjets\App\Exports\projetExport;
use Modules\PkgProjets\App\Requests\tagRequest;
use Modules\PkgProjets\Repositories\TagRepository;
use Maatwebsite\Excel\Facades\Excel;

class TagController extends AppBaseController
{
    protected $tagRepository;
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $tagsData = $this->tagRepository->searchData($searchQuery);
                return view('pkg_projets::tag.index', compact('tagsData'))->render();
            }
        }
        $tagsData = $this->tagRepository->paginate();
        return view('pkg_projets::tag.index', compact('tagsData'));
    }


    public function create()
    {
        $dataToEdit = null;
        return view('pkg_projets::tag.create', compact('dataToEdit'));
    }


    public function store(tagRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->tagRepository->create($validatedData);
            return redirect()->route('tags.index')->with('success', __('pkg_projets::tag.singular') . ' ' . __('app.addSucées'));
        } catch (ProjectAlreadyExistException $e) {
            return back()->withInput()->withErrors(['tag_exists' => __('pkg_projets::projet/message.createProjectException')]);
        } catch (\Exception $e) {
            return abort(500);
        }
    }


    public function show(string $id)
    {
        $fetchedData = $this->tagRepository->find($id);
        return view('pkg_projets::tag.show', compact('fetchedData'));
    }


    public function edit(string $id)
    {
        $dataToEdit = $this->tagRepository->find($id);
        return view('pkg_projets::tag.edit', compact('dataToEdit'));
    }


    public function update(projetRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->tagRepository->update($id, $validatedData);
        return redirect()->route('tags.index', $id)->with('success', __('pkg_projets::tag.singular') . ' ' . __('app.updateSucées'));
    }


    public function destroy(string $id)
    {
        $this->tagRepository->destroy($id);
        return redirect()->route('tags.index')->with('success', 'Le tag a été supprimer avec succés.');
    }

}
