<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Ticket\TicketPeriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketPeriorities = TicketPeriority::all();
        return view('admin.ticket.priority.index', compact('ticketPeriorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketPriorityRequest $request)
    {
        $inputs = $request->all();
        $ticketCategory = TicketPeriority::create($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت جدید با موفقیت ثبت شد');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketPeriority $ticketPeriority)
    {
        return view('admin.ticket.priority.edit', compact('ticketPeriority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketPriorityRequest $request, TicketPeriority $ticketPeriority)
    {
        $inputs = $request->all();
        $ticketPeriority->update($inputs);
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketPeriority $ticketPeriority)
    {
        $result = $ticketPeriority->delete();
        return redirect()->route('admin.ticket.priority.index')->with('swal-success', 'اولویت با موفقیت حذف شد');
    }

    public function status(TicketPeriority $ticketPeriority)
    {
        $ticketPeriority->status = $ticketPeriority->status == 0 ? 1 : 0;
        $result = $ticketPeriority->save();
        if ($result) {
            if ($ticketPeriority->status == 0)
                return response()->json(['status' => true, 'checked' => false]);
            else
                return response()->json(['status' => true, 'checked' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
