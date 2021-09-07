<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOpportunityRequest;
use App\Http\Requests\Api\UpdateOpportunityRequest;
use App\Http\Resources\OpportunityResource;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Opportunity::class, 'opportunity');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OpportunityResource::collection(Opportunity::with(['opportunityStatus', 'client'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOpportunityRequest $request)
    {
        $opportunity = Opportunity::create($request->validated())->load(['client', 'opportunityStatus']);

        return (new OpportunityResource($opportunity))->additional(['message' => 'Opportunity created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Opportunity $opportunity
     * @return \Illuminate\Http\Response
     */
    public function show(Opportunity $opportunity)
    {
        return (new OpportunityResource($opportunity->load(['client', 'opportunityStatus'])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Opportunity $opportunity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpportunityRequest $request, Opportunity $opportunity)
    {
        $data = $request->validated();
        $data['client_id'] = $opportunity->client->id;
        $opportunity->update($data);

        return (new OpportunityResource($opportunity->refresh()->loadMissing(['client', 'opportunityStatus'])))->additional(['message' => 'Opportunity updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
