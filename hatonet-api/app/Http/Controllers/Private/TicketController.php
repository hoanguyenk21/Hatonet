<?php

namespace App\Http\Controllers\Private;

use App\Models\Ticket;
use App\Http\Controllers\ApiController;
use App\Http\Resources\Private\TicketResource;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;

class TicketController extends ApiController
{

    /**
     * Construct
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TicketResource(Ticket::paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        return new TicketResource($this->ticket->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket          $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        try {
            return new TicketResource($this->ticket->findOrFail($ticket));
        } catch (\Throwable$th) {
            return response()
                ->json(['message' => __("messages.not_content")], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket          $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest $request
     * @param  \App\Models\Ticket                     $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        try {
            $result = $this->ticket->update($ticket, $request->all());
            return response()->json($result, 200);
        } catch (\Throwable$th) {
            return response()
                ->json(['message' => __("messages.not_content")], 403);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket          $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        try {
            $result = $this->ticket->findOrFail($ticket)->destroy($ticket);
            return response()->json($result, 200);
        } catch (\Throwable$th) {
            return response()
                ->json(['message' => __("messages.not_content")], 403);
        }
    }
}
