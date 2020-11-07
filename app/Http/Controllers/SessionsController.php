<?php

namespace App\Http\Controllers;

use App\Session;
use App\Site;
use Illuminate\Http\Request;
use Validator;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $sessions = Session::all();

        return view('browse_sessions', [
            'sessions' => $sessions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('create_session', [

            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $messages = [
            'sites.required' => 'Sites are required.',
        ];

        $data = $request->all();

        $validator = Validator::make($data,
            [
                'sites' => 'required|string',
            ],
            $messages
        );

        if ($validator->fails()) {
            return redirect('sessions/create')
                ->withErrors($validator)
                ->withInput();
        }

        $session = Session::create();

        $sites = preg_split('/\r\n|[\r\n]/', $validator->valid()['sites']);

        $firstSite = false;

        foreach ($sites as $site) {

            $site = strpos($site, 'https://') === false ? 'https://' . $site : $site;

            $messages = [
                'site.url' => 'Invalid URL'
            ];

            $data = ['site' => $site];

            $validator = Validator::make([$data],
                [
                    'site' => 'url',
                ],
                $messages
            );

            if ($validator->fails()) {
                return redirect('sessions/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $site = Site::create([
                    'session_id' => $session->id,
                    'uri' => $site
                ]);
                if (!$firstSite) {
                    $firstSiteId = $site->id;
                    $firstSite = true;
                }
            }
        }

        return redirect('/sites/' . $firstSiteId . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $session = Session::findOrFail($id);

        abort_if(!is_int($session->id), 500);

        $models = $session->sites()->get();

        return view('view_results', [
            'session' => $session,
            'sites' => $models
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
