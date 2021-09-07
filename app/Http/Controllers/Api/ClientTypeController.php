<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientTypeResource;
use App\Models\ClientType;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
{
    public function index()
    {
        return ClientTypeResource::collection(ClientType::get());
    }
}
