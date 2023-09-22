<?php

declare(strict_types=1);

namespace App\Common\Models;

use App\Common\Traits\Models\StaticTableNames;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use StaticTableNames;
}
