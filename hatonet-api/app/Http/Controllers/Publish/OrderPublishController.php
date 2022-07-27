<?php

namespace App\Http\Controllers\Publish;

use App\Http\Controllers\ApiController;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Private\PackageResource;
use App\Models\Package;
use stdClass;

class OrderPublishController extends ApiController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {
    }
}
