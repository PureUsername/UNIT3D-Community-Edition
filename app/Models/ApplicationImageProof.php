<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ApplicationImageProof.
 *
 * @property int                             $id
 * @property int                             $application_id
 * @property string                          $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ApplicationImageProof extends Model
{
    use Auditable;
    use HasFactory;

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'application_id',
        'image',
    ];

    /**
     * Belongs To A Application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Application, self>
     */
    public function application(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
