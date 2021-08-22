<?php

namespace App\Http\Controllers;

use App\Actions\EquipItemAction;
use App\Actions\UnequipItemAction;
use App\Exceptions\GameException;
use App\Factories\ItemFactory;
use App\Models\Character;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /** @var Character $character */
        $character = auth()->user()->character;

        $items = $character->items()->with('evolution')->withPivot(['qty', 'equipped'])->get();

        $craftableItems = collect();

        return view('pages.items', compact('items', 'craftableItems'));

    }

    public function equip(Item $item, EquipItemAction $action)
    {

        /** @var Character $character */
        $character = auth()->user()->character;

        try {
            $action($character, $item);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->back();
    }

    public function unequip(Item $item, UnequipItemAction $action)
    {

        /** @var Character $character */
        $character = auth()->user()->character;

        try {
            $action($character, $item);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->back();
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
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
