<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function view(Request $request)
    {
        $data['title'] = 'Kalender Akademik';
        $data['m'] = $request->query('m', date('m'));
        $data['y'] = $request->query('y', date('Y'));
        $rows = Event::orderBy('end', 'DESC')
            ->orderBy('start', 'DESC')
            ->whereRaw('MONTH(start)=?', [$data['m']])
            ->whereRaw('YEAR(start)=?', [$data['y']])
            ->get();
        $data['events'] = [];
        foreach ($rows as $row) {
            $begin = new DateTime($row->start);
            $end   = new DateTime($row->end);
            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                $tanggal = $i->format("Y-m-d");
                $data['events'][$tanggal][] = $row->nama_event;
            }
        }
        return view('event.view', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Event';
        $data['limit'] = 10;
        $data['rows'] = Event::where('nama_event', 'like', '%' . $data['q'] . '%')
            ->orderBy('end', 'DESC')
            ->orderBy('start', 'DESC')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Event';
        return view('event.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'start' => 'required',
            'end' => 'required',
        ], [
            'nama_event.required' => 'Nama event harus diisi',
            'start.required' => 'Min nilai harus diisi',
            'end.required' => 'Max nilai harus diisi',
        ]);
        $event = new Event($request->all());
        $event->save();

        return redirect('event')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $data['row'] = $event;
        $data['title'] = 'Ubah Event';
        return view('event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'nama_event' => 'required',
            'start' => 'required',
            'end' => 'required',
        ], [
            'nama_event.required' => 'Nama event harus diisi',
            'start.required' => 'Min nilai harus diisi',
            'end.required' => 'Max nilai harus diisi',
        ]);
        $event->nama_event = $request->nama_event;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();
        return redirect('event')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // query("DELETE FROM tb_relasi WHERE kode_event=?", [$event]);
        $event->delete();
        return redirect('event')->with('message', 'Data berhasil dihapus!');
    }
}
