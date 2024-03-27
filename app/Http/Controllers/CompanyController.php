<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

/**
 * @group Companies
 * APIs for managing Companies
 */
class CompanyController extends Controller
{


    public function index(Request $request): CompanyCollection
    {
        $companies = Company::orderBy('created_at', 'desc')->get();

        return new CompanyCollection($companies);
    }

    public function show(Request $request, $recnum, Company $company): CompanyCollection
    {
        $companies = Company::where('codigo', $recnum)->get();
        return new CompanyCollection($companies);
    }

    public function store(CompanyStoreRequest $request): CompanyResource
    {
        $data = $request->all();
        $company = Company::create($data);
        return new CompanyResource($company);
    }

    public function update(CompanyUpdateRequest $request, $recnum, Company $company): CompanyResource
    {
        $data = $request->all();
        $update = Company::where('codigo', $recnum)->update($data);
        return new CompanyResource($company->where('codigo', $recnum)->first());
    }

    public function destroy(Request $request, $recnum, Company $company): CompanyCollection
    {
        $companies = Company::where('codigo', $recnum)->delete();
        $companies = Company::paginate();
        return new CompanyCollection($companies);
    }
}
