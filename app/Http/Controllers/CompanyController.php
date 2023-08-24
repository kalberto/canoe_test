<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::with('funds')->paginate());
    }

    public function store(CompanyRequest $request): CompanyResource
    {
        return new CompanyResource(Company::create($request->validated()));
    }

    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    public function update(CompanyRequest $request, Company $company): CompanyResource
    {
        $company->update($request->validated());

        return new CompanyResource($company);
    }

    public function destroy(Company $company): JsonResponse
    {
        $company->delete();

        return response()->json('Deleted', Response::HTTP_NO_CONTENT);
    }
}
