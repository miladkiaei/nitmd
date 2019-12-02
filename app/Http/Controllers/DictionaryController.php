<?php

namespace App\Http\Controllers;

use App\Entities\Entry;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = Entry::query()
            ->where('phrase', 'LIKE', "%{$query}%")
            ->orWhere('example', 'LIKE', "%{$query}%")
            ->orWhere('meaning', 'LIKE', "%{$query}%")
            ->orWhere('meaning_fa', 'LIKE', "%{$query}%")
            ->with(['segments' => function(Relation $q) {
                $q->orderByRaw('FIELD(segment_type, \'PRE\', \'ROOT\', \'SUF\') asc')
                ->orderBy('order');
//                var_dump($q->toSql()); exit;
            }])
            ->get();
        $data = [];
        foreach ($result as $item) {
//            var_dump($item); exit;
            $data[] = [
                'id' => $item->id,
                'name' => $item->phrase,
                'example' => $item->example,
                'meaning' => $item->meaning,
                'meaning_fa' => $item->meaning_fa,
                'segments' => array_map(function($segment) {
//                    var_dump($segment); exit;
                    return [
                        'id' => $segment['id'],
                        'segment_type' => $segment['segment_type'],
                        'content' => $segment['content'],
                        'description' => $segment['description'],
                    ];
                }, $item->segments->toArray())
            ];
        }
        return $data;
    }

    public function getEntries()
    {
        return Entry::query()->paginate(5);
    }

    public function deleteEntry(Request $request, $id)
    {
        $entry = Entry::query()->find($id);
        $entry->delete();
        return [
            'done' => true,
        ];
    }


    public function update(Request $request, $id)
    {
        $array = $request->only(['phrase', 'example', 'meaning', 'meaning_fa']);
//        var_dump($array); exit;
        $entry = Entry::query()->find($id)->update($array);
        return [
            'done' => true,
        ];
    }


    public function insert(Request $request)
    {
        $array = $request->only(['phrase', 'example', 'meaning', 'meaning_fa']);
        $entry = new Entry();
        $entry->fill($array);
        $entry->save();
        return [
            'done' => true,
        ];
    }
}
