<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = [
            [
                'icon' => 'fa fa-users',
                'title' => 'Collaboration',
                'description' => 'Connect and collaborate with a community of IT students and professionals in real-time.'
            ],
            [
                'icon' => 'fa fa-share',
                'title' => 'Sharing',
                'description' => 'Effortlessly share your work with others.'
            ],
            [
                'icon' => 'fa fa-question',
                'title' => 'Question & Answer',
                'description' => 'Ask questions and get answers quickly.'
            ],
            [
                'icon' => 'fa fa-book',
                'title' => 'Learning Resources',
                'description' => 'Empower your learning journey with a wide range of educational content designed to support your growth in the IT field.'
            ],
        ];

        $categories = DB::select('select * from categories');

        return view('welcome', ['features' => $features, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
