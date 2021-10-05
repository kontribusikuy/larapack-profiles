<?php

namespace KontribusiKuy\LapackProfiles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KontribusiKuy\LapackProfiles\Http\Resources\ProfileResource;
use KontribusiKuy\LapackProfiles\Models\Profile;
use KontribusiKuy\Latraits\ApiResponseTrait;

class ProfileController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProfileResource::collection(Profile::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile();
        $profile = $profile->storeData($request->all());
        $profile = new ProfileResource($profile);
        return $this->responseSuccess(['message' => 'Profile created', 'data' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $externalLink
     * @return \Illuminate\Http\Response
     */
    public function show($externalLink)
    {
        $profile = Profile::findOrFail($externalLink);
        $profile = new ProfileResource($profile);
        return $this->responseSuccess(['message' => 'Profile found', 'data' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  uuid  $externalLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $externalLink)
    {
        $profile = Profile::findOrFail($externalLink);
        $profile->updateData($request->all());
        $profile = new ProfileResource($profile);
        return $this->responseSuccess(['message' => 'Profile updated', 'data' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  uuid  $externalLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($externalLink)
    {
        $profile = Profile::findOrFail($externalLink);
        $data = new ProfileResource($profile);
        $profile->deleteData(true);
        return $this->responseSuccess(['message' => 'Profile deleted', 'data' => $data]);
    }
}
