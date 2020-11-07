<?php

namespace App\Http\Controllers;

use App\Session;
use App\Site;
use Illuminate\Http\Request;
use League\Csv\Writer;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $site = Site::findOrFail($id);
        $prevSite = Site::whereId($id - 1)->whereSessionId($site->session_id)->get();
        $nextSite = Site::whereId($id + 1)->whereSessionId($site->session_id)->get();

        abort_if(!is_int($site->id), 500);

        $prev = '';

        foreach ($prevSite as $prevSiteItem) {
            $prev = $prevSiteItem->id;
        }

        $next = '';

        foreach ($nextSite as $nextSiteItem) {
            $next = $nextSiteItem->id;
        }

        return view('browse_site', [
            'site' => $site,
            'showPrevious' => is_int($prev),
            'showNext' => is_int($next),
            'prevId' => is_int($prev) ? $prev : 0,
            'nextId' => is_int($next) ? $next : 0
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, int $id)
    {
        /** @var Site $site */
        $site = Site::findOrFail($id);

        $site->notes = $request->get('notes');
        $site->decision = $request->get('decision');

        $site->save();

        $nextsiteIdis = $id + 1;

        /** @var Site $nextSite */
        $nextSite = Site::whereId($nextsiteIdis)->whereSessionId($site->session_id)->get();

        $nextSiteId = '';

        foreach ($nextSite as $next) {
            $nextSiteId = $next->id;
            $nextSessionId = $next->session_id;
            break;
        }

        if (is_int($nextSiteId)) {
            if ($nextSessionId === $site->session_id) {
                return redirect('/sites/' . $nextSiteId . '/edit');
            }
        }

        return redirect('/sessions/' . $site->session_id);
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

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \League\Csv\CannotInsertRecord
     */
    public function exportCSV(int $id)
    {
        $session = Session::findOrFail($id);

        $sites = $session->sites()->get();

        $header = ['ID', 'uri', 'decision', 'notes'];
        $records = [];

        foreach ($sites as $site) {
            $records[] = [$site->id, $site->uri, $site->decision, $site->notes];
        }

        $tmpfname = tempnam(sys_get_temp_dir(), "tnt_");
        $newPDFname = str_replace('.tmp', '.csv', $tmpfname);
        rename($tmpfname, $newPDFname);

        $csv = Writer::createFromPath($newPDFname);

        $csv->insertOne($header);

        $csv->insertAll($records);

        return \Response::download($newPDFname, 'output.csv');

    }
}
