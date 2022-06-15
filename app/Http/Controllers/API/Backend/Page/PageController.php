<?php

namespace App\Http\Controllers\API\Backend\Page;

use Illuminate\Http\Request;
use Repository\Page\PageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repository\Page\PagePostRepository;
use App\Http\Controllers\API\JsonResponseTrait;

class PageController extends Controller
{
    use JsonResponseTrait;

    protected $userPageRepo, $pagePostRepo;

    function __construct(PageRepository $userPageRepo, PagePostRepository $pagePostRepo)
    {
        $this->userPageRepo = $userPageRepo;
        $this->pagePostRepo = $pagePostRepo;
    }

    public function store(Request $request)
    {
       $this->userPageRepo->create($request->except('user_id') + ['user_id' =>  Auth::id()]);
        return $this->json('Page created');
    }

    public function storePageContent(Request $request, $pageID)
    {
        $checkUserIsAssignThePage = $this->userPageRepo->checkUserIsAssignThePage(Auth::id(), $pageID);

        if($checkUserIsAssignThePage == null)
        {
            return $this->bad('This user is not associate with this page');
        }
        else
        {
            $post = $this->pagePostRepo->create($request->except('user_id') + [
                'user_id'       =>  Auth::id(),
                'page_id'  => $pageID
            ]);
            return $this->json('Page post created',['post' => $post]);
        }
    }
}
