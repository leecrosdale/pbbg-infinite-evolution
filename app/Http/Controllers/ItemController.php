<?php

namespace App\Http\Controllers;

use App\Actions\CraftItemAction;
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

        $craftableItems = Item::craftable()->where('evolution_id', $character->evolution_id)->get();

        return view('pages.items', compact('items', 'craftableItems'));

    }

    public function craft(Item $item, CraftItemAction $action)
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
            // todo: $result = $action and return as 'status' view var
            $action($character, $item);

        } catch (GameException $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }

        return redirect()->back();
    }
}
