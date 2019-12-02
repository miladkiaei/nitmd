<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EntrySegmentType extends Model
{
    const TYPE_PREFIX = 'PRE';
    const TYPE_ROOT = 'ROOT';
    const TYPE_SUFFIX = 'SUF';
}
